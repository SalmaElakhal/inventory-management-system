<?php

namespace App\Http\Controllers;

use App\Models\ProductSizeStock;
use App\Models\ProductStock;
use App\Models\ReturnProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;


class ReturnProductsController extends Controller
{
    public function returnProduct()
    {
        return view('return_products.return');
    }

    public function returnProductSubmit(Request $request)
    {
        // return $request->all();
        //validate data
        $validate = Validator::make($request->all(), [
            'product_id' => 'required|numeric',
            'date' => 'required|string', // Correction ici
            'items' => 'required',
        ]);

        //error response
        if ($validate->fails()) {
            return  response()->json([
                'success' => false,
                'errors' => $validate->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        //store return product
        foreach ($request->items as $item) {
            if ($item['quantity'] && $item['quantity'] > 0) {
                $new_item = new ReturnProduct();
                $new_item->product_id = $request->product_id;
                $new_item->date = $request->date;
                $new_item->size_id = $item['size_id']; // Correction ici
                $new_item->quantity = $item['quantity'];
                $new_item->save();

                //product stock size update
                $psq = ProductSizeStock::where('product_id', $request->product_id)
                    ->where('size_id', $item['size_id'])
                    ->first();

                //stock in
                $psq->quantit =  $psq->quantit + $item['quantity'];

                $psq->save();
            }
        }

        flash('Return product update successfully')->success();
        return response()->json([
            'success' => true
        ], Response::HTTP_OK);
    }

    public function history()
    {
        $return_products = ReturnProduct::with(['product', 'size'])->orderBy('created_at', 'DESC')->get();
        return view('return_products.history', compact('return_products'));
    }
}
