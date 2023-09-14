<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        if ($request->type == 'stok') {
            if(($request->start_date == null) && ($request->end_date == null)){
                $stock = Stock::with('product')->OrderBy('date','desc')->limit(50)->get();
                
            }else{
                $stock = Stock::with('product')->whereBetween('date', [$request->start_date, $request->end_date])->OrderBy('date','desc')->get();
                
            }
        }else if ($request->type == 'kas') {
            if(($request->start_date == null) && ($request->end_date == null)){
                $stock = Stock::with('product')->OrderBy('date','desc')->limit(50)->get();
                
            }else{
                $stock = Stock::with('product')->whereBetween('date', [$request->start_date, $request->end_date])->OrderBy('date','desc')->get();
                
            }
        }else{
            if(($request->start_date == null) && ($request->end_date == null)){
                $stock = Stock::with('product')->where('stocks.type',$request->type)->OrderBy('date','desc')->limit(50)->get();
            }else{
                $stock = Stock::with('product')->where('stocks.type',$request->type)->whereBetween('date', [$request->start_date, $request->end_date])->OrderBy('date','desc')->get();
            }
        }

        
        
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Stok',
            'data' => [
                'stock' => $stock,
            ]
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
    public function store(Request $request)
    {
        //
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
        //
    }
}
