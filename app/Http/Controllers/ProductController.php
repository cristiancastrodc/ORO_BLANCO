<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use Redirect;
use Session;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Product::orderBy('descripcion')->get();
        return view('admin.product.index', ['productos' => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Category::all();
        return view('admin.product.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Product::create([
            'codigo' => $request['tbCodigo'],
            'descripcion' => $request['tbDescripcion'],
            'descripcion_corta' => $request['tbDescripcionCorta'],
            'precio_venta' => $request['tbPrecio'],
            'id_categoria' => $request['selCategoria'],
            ]);
        Session::flash('message', 'Producto creado correctamente.');
        return Redirect::to('/admin/productos/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Product::find($id);
        $categorias = Category::all();
        return view('admin.product.edit', ['producto' => $producto, 'categorias' => $categorias]);
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
        $producto = Product::find($id);
        if ($producto) {
            $producto->codigo = $request['tbCodigo'];
            $producto->descripcion = $request['tbDescripcion'];
            $producto->descripcion_corta = $request['tbDescripcionCorta'];
            $producto->precio_venta = $request['tbPrecio'];
            $producto->id_categoria = $request['selCategoria'];
            $producto->save();
            Session::flash('message', 'Producto actualizado correctamente.');
            return Redirect::to('admin/productos');
        } else {
            Session::flash('message', 'Error.');
            return Redirect::to('admin/productos');
        };
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

    /**
     * Devolver la lista de productos filtrados
     */
    public function filtrar($filtro = '')
    {
        if ($filtro != '') {
            return Product::where('descripcion', 'like', $filtro . '%')
                          ->orWhere('descripcion', 'like', '% ' . $filtro . '%')
                          ->orderBy('descripcion')->get();
        } else {
            return Product::orderBy('descripcion')->get();
        }
    }
}
