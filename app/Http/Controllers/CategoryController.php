<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //TODO: añadir soporte de eliminacion
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenant = tenant();
        $categorias = Category::where('tenant_id', $tenant->id)->get();
        return view('categories', ['categories' => $categorias]);
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
        $request->validate(['categoryName' => 'required|min:3']);

        $category = new Category($request->only([
            'categoryName'
        ]));
        $category->tenant_id = $tenant->id;
        $category->save();

        return redirect('/' . $tenant->path . '/categories')->with("success", "Categoria creada");
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
        $tenant = tenant();
        $category = Category::where('tenant_id', $tenant->id)->find($id);
        $products = $category->products();

        if ($products->count() != 0) {
            return redirect('/' . $tenant->path . '/categories')->withErrors("No se puede eliminar la categoria '" . $category->categoryName . "', por que tiene productos asignados");
        } else {
            $category->delete();
            return redirect('/' . $tenant->path . '/categories')->with('success', 'Se elimino la categoria');
        }
    }
}
