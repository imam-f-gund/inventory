<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use RealRashid\SweetAlert\Facades\Alert;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::orderBy('date_input', 'DESC')->paginate(12);
        
        return response()->json([
            'success' => true,
            'message' => 'List Data Product',
            'data' => $product
        ], 200); 
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
    public function store(StockRequest $request)
    {
       
        $product = Product::find($request->product_id);
        $stock = new Stock;
        if ($request->type == 'in') {
            $stock->qty = $request->qty;
            $product->qty = $product->qty + $request->qty;
        } else {
            if ($request->qty > $product->qty) {
            
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi',
                    'data' => null
                ], 200);
            }

            $stock->qty = $request->qty;
            $product->qty = $product->qty - $request->qty;
        }

        $stock->product_id = $request->product_id;
        $stock->date = now();
        $stock->note = $request->note;
        $stock->type = $request->type;
        $stock->save();
       
        $product->save();

        return response()->json([
            'success' => true,
            'message' => 'Stok berhasil diupdate',
            'data' => $stock
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock = Stock::where('product_id', $id)->orderBy('date', 'DESC')->get();
        $product = Product::find($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Stok',
            'data' => [
                'product' => $product,
                'stock' => $stock
            ]
        ], 200);
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
    public function update(StockRequest $request, $id)
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
        //
    }
}
