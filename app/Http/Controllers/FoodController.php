<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Store;
use App\Models\Food;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Store $store
     * @return Renderable
     */
    public function index(Store $store)
    {
        $binding = [
            'previous_url' => route('store.index'),
            'datatable_url' => route('store.food.datatable',$store),
        ];
        return view('store/food/index', $binding);
    }

    /**
     * Show the specified resource.
     * @param Store $store
     * @param Food $food
     * @return Renderable
     */
    public function show(Store $store, Food $food)
    {
        $binding = [
            'model' => $food,
            'previous_url' => route('store.food.index',$store),
        ];
        return view('store/food/show', $binding);
    }

    /**
     * dataTable Server Side
     * @param Request $request
     * @param Store $store
     * @return array
     */
    public function datatable(Request $request, Store $store)
    {
        $query = $store->foods();

        $textList = ['name', 'unit_price', ''];
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
                'show_url' => route('store.food.show', ['store'=>$store,'food'=>$item]),
            ];

            $operateView = view('store/food/components/operate', $operateData)->render();

            $data[] = [
                $item->name,
                $item->unit_price,
                $item->desc,
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
