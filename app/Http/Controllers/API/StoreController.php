<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

use App\Models\Store;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if( Cache::has('stores') ){
            $stores = Cache::get('stores');
        }else{
            $stores = Cache::rememberForever('stores', function () {
                $stores = Store::select('id','name','phone','business_time','lat','lng')->get()->keyBy('id');

                return $stores;
            });
        }

        return response()->json([
            "success" => true,
            "data" => $stores,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => [
                  'required',
                  'max:255'
                ],
                'phone' => ['required','max:20'],
                'business_time' => ['required','max:20'],
                'lat' => ['required','max:20'],
                'lng' => ['required','max:20'],
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                "success" => false,
                "data" => $e->errors(),
            ], 400);
        }

        $store = Store::create($validated);

        return response()->json([
            "success" => true,
            "data" => $store->only(['id','name','phone','business_time','lat','lng']),
        ], 200);
    }

    /**
     * Show the specified resource.
     * @param int $store_id
     * @return Renderable
     */
    public function show($store_id)
    {
        if( Cache::has('store_'.$store_id) ){
            $cached_store = Cache::get('store_'.$store_id);
        }else{
            $cached_store = Cache::rememberForever('store_'.$store_id, function () use($store_id){
                $cached_store = Store::findOrFail($store_id)->only(['id','name','phone','business_time','lat','lng']);

                return $cached_store;
            });
        }

        return response()->json([
            "success" => true,
            "data" => $cached_store,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $store_id
     * @return Renderable
     */
    public function update(Request $request, $store_id)
    {
        $store = Store::findOrFail($store_id);
        $validated = $request->validate([
            'name' => [
              'required',
              'max:255'
            ],
            'phone' => ['required','max:20'],
            'business_time' => ['required','max:20'],
            'lat' => ['required','max:20'],
            'lng' => ['required','max:20'],
        ]);

        $store->update($validated);

        return response()->json([
            "success" => true,
            "data" => $store->only(['id','name','phone','business_time','lat','lng']),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param int $store_id
     * @return Renderable
     */
    public function destroy(Request $request, $store_id)
    {
        $store = Store::findOrFail($store_id);
        $store->delete();

        return response()->json([
            "status" => "success",
            "content" => "刪除成功",
        ], 200);
    }
}
