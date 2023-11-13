<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Product::all();
        $categorias = Category::all();
        return view('products', ['products' => $productos, 'categories' => $categorias]);
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
        $request->validate([
            'productName' => 'required|min:3',
            'category_id' => 'required',
            'productPrice' => 'required',
            'productUnit' => 'required',
            'productStock' => 'required',
            'productMinStock' => 'required'
        ]);

        $product = new Product($request->only([
            'productName',
            'category_id',
            'productPrice',
            'productUnit',
            'productStock',
            'productMinStock',
            'productDescription'
        ]));
        $product->save();

        return redirect('/products')->with("success", "Producto creado");
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
        //TODO: Revisar si el producto esta en ventas para no eliminarlo
        $product = Product::find($id);
        $product->delete();
        return redirect('products')->with('success', 'Se elimino el producto');
    }
}
