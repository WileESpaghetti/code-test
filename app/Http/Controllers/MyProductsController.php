<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class MyProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return response()->json($user->products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $newProducts = [];

        $getId = function ($p) {return $p->id;};
        $existingProductIds = $user->products->map($getId);

        foreach ($request->all() as $productData) {
            if (empty($productData['id']) || $existingProductIds->contains($productData['id'])) {
                continue;
            }

            $newProducts[] = Product::findOrFail($productData['id']);
        }


        $user->products()->saveMany($newProducts);
        $user->load('products');

        return response()->json($user->products);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $user->products()->detach($id);

        return response()->json(null, 204);
    }
}
