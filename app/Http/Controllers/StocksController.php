<?php

namespace App\Http\Controllers;

use App\Models\ProductStock;
use App\Models\ProductSizeStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;


class StocksController extends Controller
{
    public function stock()
    {
        return view('stocks.stock');
    }

    public function stockSubmit(Request $request)
    {
        // return $request->all();
        //validate data
        $validate = Validator::make($request->all(), [
            'product_id' => 'required|numeric',
            'date' => 'required|string', // Correction ici
            'stock_type' => 'required|string', // Correction ici
            'items' => 'required',
        ]);

        //error response
        if ($validate->fails()) {
            return  response()->json([
                'success' => false,
                'errors' => $validate->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        //store produt stock
        foreach ($request->items as $item) {
            if ($item['quantity'] && $item['quantity'] > 0) {
                $new_item = new ProductStock();
                $new_item->product_id = $request->product_id;
                $new_item->date = $request->date;
                $new_item->status = $request->stock_type;
                $new_item->size_id = $item['size_id']; // Correction ici
                $new_item->quantity = $item['quantity'];
                $new_item->save();

                //product stock size
                $psq = ProductSizeStock::where('product_id', $request->product_id)
                    ->where('size_id', $item['size_id'])
                    ->first();
                if ($request->stock_type == ProductStock::STOCK_IN) {
                    //stock in
                    $psq->quantit =  $psq->quantit + $item['quantity'];
                } else {
                    //stock out
                    $psq->quantit =  $psq->quantit - $item['quantity'];
                }
                $psq->save();
            }
        }

        flash('Stock update successfully')->success();
        return response()->json([
            'success' => true
        ], Response::HTTP_OK);
    }

    public function stockHistory()
    {
        $stocks = ProductStock::with(['product', 'size'])->orderBy('created_at', 'DESC')->get();
        return view('stocks.history', compact('stocks'));
    }
}
