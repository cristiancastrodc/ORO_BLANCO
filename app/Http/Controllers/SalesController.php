<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Product;
use App\SaleSession;
use App\VoucherConfig;
use Auth;
use Redirect;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products = Product::orderBy('descripcion')->get();
        //return view('ventas.pos1', compact('products'));
        return view('ventas.pos1');
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

    /**
     * Verificar si el usuario apertura la sesión de ventas, sino redireccionar
     */
    public function verificarSesion() {
        $sesion = SaleSession::recuperarSesion(Auth::user()->id);
        if ($sesion) {
            return Redirect::to('/ventas/punto_de_venta');
        } else {
            return Redirect::to('/ventas/caja/aperturar');
        }
    }

    /**
     * Aperturar la sesión de ventas
     */
    public function aperturarSesion() {
        return view('ventas.caja.aperturar');
    }

    /**
     * Aperturar la sesión de ventas
     */
    public function guardar(Request $request) {
        $cliente = $request->input('cliente');
        $venta = $request->input('venta');
        $detalle_venta = $request->input('detalle');
        $total = $request->input('total');
        //Cliente
        $id_cliente = Customer::where('numero_documento', '=', $cliente["numero_documento"])->first();
        if ($id_cliente) {
            $id_cliente->nombre_razon_social = $cliente["nombre_razon_social"];
            $id_cliente->direccion = $cliente["direccion"];
            $id_cliente->save();
        } else {
            Customer::create([
            'nombre_razon_social' => $cliente["nombre_razon_social"],
            'numero_documento' => $cliente["numero_documento"],
            'direccion' => $cliente["direccion"]
            ]);
        }
        // Venta
        $tipo_comprobante = $venta["tipo"];
        $voucher = VoucherConfig::where('tipo_comprobante', '=', $tipo_comprobante)->first();
        $serie_comprobante = $voucher->serie_comprobante;
        $numero_comprobante = str_pad(intval($voucher->numero_actual) + 1, 8, '0', STR_PAD_LEFT);

        return response()->json([
            "mensaje" => $venta
            ]);
    }

    /**
     * Imprimir ticket de venta
     */
    public function imprimirTicket() {
        return view('ventas.ticket');
    }
}
