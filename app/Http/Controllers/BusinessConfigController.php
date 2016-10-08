<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\BusinessConfig;
use Redirect;
use Session;

class BusinessConfigController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $configuracion = BusinessConfig::find(1);
        $ruc = '';
        $razon_social = '';
        $direccion = '';
        $telefono = '';
        $eslogan = '';
        if ($configuracion) {
            $ruc = $configuracion->ruc;
            $razon_social = $configuracion->razon_social;
            $direccion = $configuracion->direccion;
            $telefono = $configuracion->telefono;
            $eslogan = $configuracion->eslogan;
        }
        return view('admin.business_config.create', compact('ruc', 'razon_social', 'direccion', 'telefono', 'eslogan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_empresa = BusinessConfig::find(1);

        if ($id_empresa) {
            $id_empresa->ruc = $request['tbRuc'];
            $id_empresa->razon_social = $request['tbRazon_Social'];
            $id_empresa->direccion = $request['tbDireccion'];
            $id_empresa->telefono = $request['tbTelefono'];
            $id_empresa->eslogan = $request['tbEslogan'];
            $id_empresa->save();
        } else {
            BusinessConfig::create([
            'ruc' => $request['tbRuc'],
            'razon_social' => $request['tbRazon_Social'],
            'direccion' => $request['tbDireccion'],
            'telefono' => $request['tbTelefono'],
            'eslogan' => $request['tbEslogan'],
            ]);
        }

        Session::flash('message', 'Datos de empresa guardados correctamente.');
        return Redirect::to('/dashboard');
        //return 'guardado';
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
