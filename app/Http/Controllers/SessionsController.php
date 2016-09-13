<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SaleSession;
use Auth;
use Redirect;
use Session;
use App\User;

class SessionsController extends Controller
{
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
        $fecha_hora_inicio = date("Y-m-d H:i:s");
        SaleSession::create([
            'fecha_hora_inicio' => $fecha_hora_inicio,
            'id_usuario' => Auth::user()->id,
            'monto_inicial' => $request['tbMontoInicial'],
            'monto_actual' => $request['tbMontoInicial'],
            'estado' => 'abierta',
            ]);
        return Redirect::to('/ventas/punto_de_venta');
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

    public function cerraCaja()
    {
        $sesion = SaleSession::where('id_usuario', '=', Auth::user()->id)
                             ->where('estado','=', 'abierta')
                             ->first();
        if ($sesion) {
            return view('ventas.caja.cierre');

        }else{
            Session::flash('message', 'No se encontro ninguna caja con sesión aperturada.');
            return Redirect::to('/dashboard');
        }
    }

    public function confimarCierre()
    {
        $fecha_hora_fin = date("Y-m-d H:i:s");
        $sesion = SaleSession::where('id_usuario', '=', Auth::user()->id)
                             ->where('estado','=', 'abierta')
                             ->first();

        $sesion->fecha_hora_fin = $fecha_hora_fin;
        $sesion->estado = 'cerrada';
        $sesion->save();

        Session::flash('message', 'Caja Cerrada Correctamente.');
        return Redirect::to('/ventas/resumen_sesion/' . $sesion->id);
    }

    public function resumenCaja($id_sesion)
    {
        $sesion = SaleSession::find($id_sesion);
        $usuario = User::find($sesion->id_usuario);
        $nombre = $usuario->nombre . ' ' . $usuario->apellidos;
        return view('ventas.caja.resumen', compact('sesion', 'nombre'));
    }
}
