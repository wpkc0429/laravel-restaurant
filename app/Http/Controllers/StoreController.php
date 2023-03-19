<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Store;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $binding = [
            'datatable_url' => route('store.datatable'),
        ];
        return view('store/index', $binding);
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
            'previous_url' => route('store.index'),
            'food_url' => route('store.food.index', $store),
        ];
        return view('store/show', $binding);
    }

    /**
     * dataTable Server Side
     * @param Request $request
     * @return array
     */
    public function datatable(Request $request)
    {
        $query = Store::query();

        $textList = ['name', '', 'business_time'];
        foreach ($request->input('order', []) as $option) {
            $query = $query->orderBy($textList[$option['column']], $option['dir']);
        }

        if ($request->input('search')['value']) {
            $val = $request->input('search')['value'];
            $query = $query->whereNested(function ($query) use ($val) {
                $query->where('name', 'like', "%" . $val . "%");
            });
        }

        $total = $query->count();
        $filtered = $query->get();
        $items = $query->skip($request->input('start'))
                        ->limit($request->input('length'))
                        ->get();

        $data = [];
        foreach ($items as $item) {
            $operateData = [
                'item' => $item,
                'show_url' => route('store.show', $item),
                'food_url' => route('store.food.index', $item),
            ];

            $operateView = view('store/components/operate', $operateData)->render();

            $data[] = [
                $item->name,
                $item->phone,
                $item->business_time,
                $operateView,
            ];
        }

        return [
            'draw' => $request->input('draw'),
            'recordsTotal' => $total,
            'recordsFiltered' => $filtered->count(),
            'data' => $data,
        ];
    }
}
