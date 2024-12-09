<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSizeStock;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(relations: ['category', 'brand'])->get();
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
            'sku' => 'required|string|max:100|unique:products',
            'name' => 'required|string|min:2|max:200',
            'image' => 'required|image|mimes:jpeg,jpg,png',
            'cost_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
            'year' => 'required',
            'description' => 'required|max:200',
            'status' => 'required|numeric',
        ]);
        //error response
        if ($validate->fails()) {
            return  response()->json([
                'success' => false,
                'errors' => $validate->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //store product
        $product = new Product();
        $product->user_id = Auth::id(); 
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->sku = $request->sku;
        $product->name = $request->name;
        // $product->image = $request->image;
        $product->cost_price = $request->cost_price;
        $product->retail_price = $request->retail_price;
        $product->year = $request->year;
        $product->description = $request->description;
        $product->status = $request->status;

        //upload image
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = Str::random(60) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('product_images', $name);
                $product->image = $name;
            }
        } catch (\Exception $e) {
            dd('Erreur lors de l\'upload', $e->getMessage());
        }


        //save product
        $product->save();

        //store product size stock
        if ($request->items) {
            foreach (json_decode($request->items) as $item) {
                $size_stock = new ProductSizeStock();
                $size_stock->product_id = $product->id;
                $size_stock->size_id = (int) $item->size_id; // Conversion en entier
                $size_stock->location = $item->location;
                $size_stock->quantity = $item->quantity;
                $size_stock->save();
            }
        }
        flash('Product updated successfuly')->success();

        return  response()->json([
            'success' => true,
        ], Response::HTTP_OK);
    }
    /////




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with(['category', 'brand', 'product_stock.size'])
            ->where('id', $id)
            ->first();

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::where('id', $id)->with(['product_stock'])->first();
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate data
        $validate = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'sku' => 'required|string|max:100|unique:products,sku,'.$id,
            'name' => 'required|string|min:2|max:200',
            'image' => 'nullable|image|mimes:jpeg,jpg,png',
            'cost_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
            'year' => 'required',
            'description' => 'required|max:200',
            'status' => 'required|numeric',
        ]);
        //error response
        if ($validate->fails()) {
            return  response()->json([
                'success' => false,
                'errors' => $validate->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //update product
        $product =  Product::findOrFail($id);
        $product->user_id = Auth::id();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->sku = $request->sku;
        $product->name = $request->name;
        // $product->image = $request->image;
        $product->cost_price = $request->cost_price;
        $product->retail_price = $request->retail_price;
        $product->year = $request->year;
        $product->description = $request->description;
        $product->status = $request->status;

        //upload image
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = Str::random(60) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('product_images', $name);
                $product->image = $name;
            }
        } catch (\Exception $e) {
            dd('Erreur lors de l\'upload', $e->getMessage());
        }


        //save product
        $product->save();

        //delete old stock
        ProductSizeStock::where('product_id', $id)->delete();


        //store product size stock
        if ($request->items) {
            foreach (json_decode($request->items) as $item) {
                $size_stock = new ProductSizeStock();
                $size_stock->product_id = $product->id;
                $size_stock->size_id = (int) $item->size_id; // Conversion en entier
                $size_stock->location = $item->location;
                $size_stock->quantity = $item->quantity;
                $size_stock->save();
            }
        }

        flash('Product updated successfuly')->success();

        return  response()->json([
            'success' => true,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd('Method destroy is working!');

        $product = Product::findOrFail($id);
        $product->delete();
        flash('Product deleted successfully')->success();
        return back();
    }

    public function getProductsJson(){
        $products = Product::with(['product_stocks.size'])->get();
        return response()->json([
            'success' => true,
            'data' => $products,
        ], Response::HTTP_OK);
     
    }
}
