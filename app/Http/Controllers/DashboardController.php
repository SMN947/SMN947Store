<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Sale::all();

        $topSell = DB::table('sale_details')
            ->join('products', 'products.id', '=', 'sale_details.product_id')
            ->selectRaw(env('DB_PREFIX', 'abc') . 'sale_details.product_id, _products.productName, sum(' . env('DB_PREFIX', 'abc') . 'sale_details.amount) amount')
            ->groupBy('sale_details.product_id', 'products.productName')
            ->orderBy('amount', 'desc')
            ->get();

        $stock = DB::table('products')
            ->selectRaw('productName,productStock,productMinStock,productStock-productMinStock toMinStock')
            ->orderBy(DB::raw('productStock-productMinStock', 'asc'))
            ->get();

        return view('dashboard', ["sales" => $ventas, "topSell" => $topSell, "stock" => $stock]);
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
