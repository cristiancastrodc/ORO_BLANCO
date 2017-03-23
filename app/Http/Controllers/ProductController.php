<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\SaleDetail;
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
    return view('admin.product.index');
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
      'estado' => $request['estado'],
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
      $producto->estado = $request['estado'];
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
    $respuesta = [];
    try {
      $producto = Product::find($id);
      if ($producto) {
      $nro_ventas = SaleDetail::where('id_producto', $id)->count();
      if ($nro_ventas == 0) {
        $producto->delete();
        $respuesta['resultado'] = 'true';
      } else {
        $respuesta['resultado'] = 'false';
        $respuesta['mensaje'] = 'Producto ya se utilizó en alguna operación.';
      }
      }
      else {
      $respuesta['resultado'] = 'false';
      $respuesta['mensaje'] = 'Producto no existe.';
      }
    } catch (Exception $e) {
      $respuesta['resultado'] = 'false';
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $respuesta;
  }

  /**
   * Devolver la lista de productos filtrados
   */
  public function filtrar($filtro = '')
  {
    $productos = Product::where('estado', 1)
                        ->orderBy('descripcion');
    if ($filtro != '') {
      $productos->where('descripcion', 'like', $filtro . '%')
                ->orWhere('descripcion', 'like', '% ' . $filtro . '%');
    }
    return $productos->get();
  }

  /**
   * Devuelve la lista de productos de acuerdo al estado.
   *
   * @param  int  $estado
   * @return \Illuminate\Http\Response
   */
  public function filtrarEstado($soloHabilitados = 0)
  {
    $productos = Product::orderBy('descripcion');
    if ($soloHabilitados == 1) {
      $productos->where('estado', 1);
    }
    return $productos->get();
  }
}
