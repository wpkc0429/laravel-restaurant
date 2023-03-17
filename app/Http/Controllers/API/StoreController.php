<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $binding = [
            'create_url' => route('management-panel.examination.create'),
            'datatable_url' => route('management-panel.examination.datatable'),
        ];
        return view('exam::management-panel/examination/index', $binding);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $model = new Store;
        $validated = $request->validate([
            'department_id' => [
              'required',
              'integer',
              function ($attribute, $value, $fail) use($user){
                  if (!$user->isSuperAdmin()&&!$user->departments->pluck('id')->contains($value)) {
                      $fail(':attribute 錯誤。');
                  }
              },
              'exists:Modules\Department\Entities\Department,id'
            ],
            'academic_year' => ['required',Rule::in(AcademicYear::getInstanceId())],
            'semester' => ['required',Rule::in(Semester::getInstanceId())],
            'type_id' => ['required',Rule::in(StoreType::getInstanceId())],
            'name' => 'required|string|max:255',
            'need_score_leaderboard' => 'required|integer|in:0,1',
        ], [], $model->validation_field_attribute);
        $validated['created_user'] = $user->uid;
        $validated['updated_user'] = $user->uid;

        $department = Department::find($validated['department_id']);
        $validated['department_name'] = $department->name;

        if ($user->hasCapability(['question_manager'])) {
          $validated['is_public'] = 1;
        }

        $store = Store::create($validated);

        return redirect()->route('management-panel.examination.show', $store)
                         ->with('alert', ['type' => 'success', 'content' => '新增成功']);
    }

    /**
     * Show the specified resource.
     * @param Store $store
     * @return Renderable
     */
    public function show(Store $store)
    {
        $binding = [
            'model' => $store,
            'previous_url' => route('management-panel.examination.index'),
            'index_url' => route('management-panel.examination.index'),
            'edit_url' => route('management-panel.examination.edit', $store),
            'delete_url' => route('management-panel.examination.destroy', $store),
        ];
        return view('exam::management-panel/examination/show', $binding);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Store $store
     * @return Renderable
     */
    public function edit(Store $store)
    {
        $user = request()->user();
        if (!$user->isSuperAdmin()) {
            $user_department_ids = $user->departments->pluck('id');
            $department_options = Department::whereIn('id',$user_department_ids)->get();
        }else {
            $department_options = Department::all();
        }
        $binding = [
            'model' => $store,
            'is_super_admin' => \Auth::user()->isSuperAdmin(),
            'department_options' => $department_options,
            'academic_year_options' => AcademicYear::getInstanceMap(),
            'semester_options' => Semester::getInstanceMap(),
            'type_options' => StoreType::getInstances(),
            'previous_url' => route('management-panel.examination.show', $store),
        ];
        return view('exam::management-panel/examination/edit', $binding);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Store $store
     * @return Renderable
     */
    public function update(Request $request, Store $store)
    {
        $user = $request->user();
        $model = new Store;
        $validated = $request->validate([
            'department_id' => [
              'required',
              'integer',
              function ($attribute, $value, $fail) use($user){
                  if (!$user->isSuperAdmin()&&!$user->departments->pluck('id')->contains($value)) {
                      $fail(':attribute 錯誤。');
                  }
              },
              'exists:Modules\Department\Entities\Department,id'
            ],
            'academic_year' => ['required',Rule::in(AcademicYear::getInstanceId())],
            'semester' => ['required',Rule::in(Semester::getInstanceId())],
            'type_id' => ['required',Rule::in(StoreType::getInstanceId())],
            'name' => 'required|string|max:255',
            'need_score_leaderboard' => 'required|integer|in:0,1',
        ], [], $model->validation_field_attribute);

        $validated['updated_user'] = $user->uid;
        $department = Department::find($validated['department_id']);
        $validated['department_name'] = $department->name;

        $store->update($validated);
        \Logger::save("update", sprintf('更新考試：%d', $store->id));
        return redirect()->route('management-panel.examination.show', $store)
                         ->with('alert', ['type' => 'success', 'content' => '更新成功']);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param Store $store
     * @return Renderable
     */
    public function destroy(Request $request, Store $store)
    {
        $quizzes = Quiz::where('examination_id',$store->id)->get();
        foreach($quizzes as $quiz){
            QuizBlock::where('quiz_id',$quiz->id)->delete();
            QuizQuestion::where('quiz_id',$quiz->id)->delete();
            QuizCandidate::where('quiz_id',$quiz->id)->delete();
            $quiz->delete();
        }
        StoreCandidate::where('examination_id',$store->id)->delete();

        $store = Store::find($store->id);
        $store->delete();

        \Logger::save("delete", '刪除考試：' . $store->id);
        if (filter_var($request->get('need_flash_alert', false), FILTER_VALIDATE_BOOLEAN)) {
            $request->session()->flash('alert', ['type' => 'success', 'content' => '刪除成功']);
        }
        return response()->json([
            "status" => "success",
            "content" => "刪除成功",
        ], 200);
    }
}
