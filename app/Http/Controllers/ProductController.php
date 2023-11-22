<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class dinamicForm
{
    public $label;
    public $type;
    public $id;
    public $name;
    public $options;

    public function __construct($label, $type, $id, $name, $options = [])
    {
        $this->label = $label;
        $this->type = $type;
        $this->id = $id;
        $this->name = $name;
        $this->options = $options;
    }
}

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
        $newProductFormFields = [
            new dinamicForm('Nombre del producto', 'text', 'productName', 'productName'),
            new dinamicForm('Categoria', 'select', 'category_id', 'category_id', $categorias),
            new dinamicForm('Precio de Compra', 'number', 'productBuyPrice', 'productBuyPrice'),
            new dinamicForm('Precio de Venta', 'number', 'productSellPrice', 'productSellPrice'),
            new dinamicForm('Unidad (Kg, lb, unidad, pliego, etc)', 'text', 'productUnit', 'productUnit'),
            new dinamicForm('Cantidad disponible', 'number', 'productStock', 'productStock'),
            new dinamicForm('Cantidad minima para alertar', 'number', 'productMinStock', 'productMinStock'),
            new dinamicForm('Descripcion', 'text', 'productDescription', 'productDescription'),
        ];
        return view('products', [
            'products' => $productos,
            'categories' => $categorias,
            'newProductFormFields' => $newProductFormFields
        ]);
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
            'productBuyPrice' => 'required',
            'productSellPrice' => 'required',
            'productUnit' => 'required',
            'productStock' => 'required',
            'productMinStock' => 'required'
        ]);

        $product = new Product($request->only([
            'productName',
            'category_id',
            'productBuyPrice',
            'productSellPrice',
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
        $request->validate([
            'productName' => 'required|min:3',
            'category_id' => 'required',
            'productBuyPrice' => 'required',
            'productSellPrice' => 'required',
            'productUnit' => 'required',
            'productStock' => 'required',
            'productMinStock' => 'required'
        ]);

        $product = Product::find($id);
        $product->update($request->only([
            'productName',
            'category_id',
            'productBuyPrice',
            'productSellPrice',
            'productUnit',
            'productStock',
            'productMinStock',
            'productDescription'
        ]));

        return redirect('/products')->with("success", "Producto actualizado");
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
