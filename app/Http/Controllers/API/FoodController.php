<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

use App\Models\Food;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param int $store_id
     * @return Renderable
     */
    public function index($store_id)
    {
        if( Cache::has('store_'.$store_id.'_foods') ){
            $foods = Cache::get('store_'.$store_id.'_foods');
        }else{
            $foods = Cache::rememberForever('store_'.$store_id.'_foods', function () use($store_id){
                $foods = Food::select('id','store_id','name','unit_price','desc')->where('store_id',$store_id)->get()->keyBy('id');
                
                return $foods;
            });
        }
        
        return response()->json([
            "success" => true,
            "data" => $foods,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param int $store_id
     * @return Renderable
     */
    public function store(Request $request, $store_id)
    {
        try {
            $validated = $request->validate([
                'name' => [
                  'required',
                  'max:255'
                ],
                'unit_price' => ['required','integer','max:100000'],
                'desc' => ['required','max:65535'],
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                "success" => false,
                "data" => $e->errors(),
            ], 400);
        }

        $validated['store_id'] = $store_id;
        
        $food = Food::create($validated);

        return response()->json([
            "success" => true,
            "data" => '新增成功',
        ], 200);
    }

    /**
     * Show the specified resource.
     * @param int $store_id
     * @param int $food_id
     * @return Renderable
     */
    public function show($store_id, $food_id)
    {
        if( Cache::has('store_'.$store_id.'_food_'.$food_id) ){
            $cached_food = Cache::get('store_'.$store_id.'_food_'.$food_id);
        }else{
            $cached_food = Cache::rememberForever('store_'.$store_id.'_food_'.$food_id, function () use($store_id, $food_id){
                $cached_food = Food::where(['id'=>$food_id,'store_id'=>$store_id])->firstOrFail()->only(['id','store_id','name','unit_price','desc']);
                
                return $cached_food;
            });
        }

        return response()->json([
            "success" => true,
            "data" => $cached_food,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $store_id
     * @param int $food_id
     * @return Renderable
     */
    public function update(Request $request, $store_id, $food_id)
    {
        $food = Food::where(['id'=>$food_id,'store_id'=>$store_id])->firstOrFail();
        $validated = $request->validate([
              'name' => [
                'required',
                'max:255'
              ],
              'unit_price' => ['required','integer','max:100000'],
              'desc' => ['required','max:65535'],
        ]);

        $food->update($validated);     
        
        return response()->json([
            "success" => true,
            "data" => '更新成功',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param int $store_id
     * @param int $food_id
     * @return Renderable
     */
    public function destroy(Request $request, $store_id, $food_id)
    {
        $food = Food::where(['id'=>$food_id,'store_id'=>$store_id])->firstOrFail();
        $food->delete();

        return response()->json([
            "status" => "success",
            "content" => "刪除成功",
        ], 200);
    }
}
