<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenant = tenant();
        $productos = Product::where('tenant_id', $tenant->id)->get();
        return view('pos', ['products' => $productos]);
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
        $tenant = tenant();
        $venta = new Sale($request->only(['total']));
        $venta->user_id = auth()->user()->id;
        $venta->tenant_id = $tenant->id;
        $venta->save();
        $idVenta = $venta->id;

        foreach ($request->cartProducts as $key => $value) {
            $productStock = DB::table('products')->where("id", $value['productId'])->value('productStock');
            if ($productStock >= $value['amount']) {
                $product = new SaleDetails([
                    'sale_id' => $idVenta,
                    'product_id' => $value['productId'],
                    'amount' => $value['amount'],
                    'productSellPrice' => $value['productSellPrice'],
                    'productBuyPrice' => $value['productBuyPrice'],
                    'subTotal' => $value['subTotal'],
                ]);
                $product->tenant_id = $tenant->id;
                $product->save();
                DB::table('products')
                    ->where("id", $value['productId'])
                    ->update(['productStock' => $productStock - $value['amount']]);
            } else {
                //TODO: Actualizar factura en front o detener la compra
            }
        }
        $response = array(
            "message" => "Se ha creado la venta",
            "idVenta" => $idVenta
        );
        return response(json_encode($response), 200)->header('Content-Type', 'text/json');
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
