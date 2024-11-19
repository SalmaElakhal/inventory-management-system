<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate data
        $validate = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'sku' => 'required|string|max:100|unique:produits',
            'name' => 'required|string|min:2|max:200',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:1024',
            'cost_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
            'year' => 'required',
            'description' => 'required|max:200',
            'status' => 'required|numeric',
        ]);
        //error response
        if($validate->fails()){
           return  response()->json([
                'success' => false,
                'errors' => $validate->errors()
            ],\Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        return $request->all();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
