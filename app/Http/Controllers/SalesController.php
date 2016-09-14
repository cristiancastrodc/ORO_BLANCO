<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\BusinessConfig;
use App\Customer;
use App\Product;
use App\Sale;
use App\SaleAmounts;
use App\SaleDetail;
use App\SaleSession;
use App\VoucherConfig;
use Auth;
use DB;
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
        $sesion = SaleSession::recuperarSesion(Auth::user()->id);
        if ($sesion) {
            return view('ventas.pos');
        } else {
            return Redirect::to('/ventas/caja/aperturar');
        }
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
        $total = floatval($request->input('total'));
        $efectivo = floatval($request->input('efectivo'));
        $resultado = false;
        $mensaje = '';
        $ruta = '';
        try {
            DB::beginTransaction();

            // --- Realizar la venta
            // Cliente
            $id_cliente = '';
            if ($cliente) {
                $cliente_aux = Customer::where('numero_documento', '=', $cliente["numero_documento"])->first();
                if ($cliente_aux) {
                    $id_cliente = $cliente_aux->id;
                    $cliente_aux->nombre_razon_social = $cliente["nombre_razon_social"];
                    $cliente_aux->direccion = $cliente["direccion"];
                    $cliente_aux->save();
                } else {
                    $id_cliente =
                    Customer::create([
                    'nombre_razon_social' => $cliente["nombre_razon_social"],
                    'numero_documento' => $cliente["numero_documento"],
                    'direccion' => $cliente["direccion"]
                    ])->id;
                }
            }
            // Venta
            $tipo_comprobante = $venta["tipo"];
            $voucher = VoucherConfig::where('tipo_comprobante', '=', $tipo_comprobante)->first();
            $serie_comprobante = $voucher->serie_comprobante;
            $numero_comprobante = str_pad(intval($voucher->numero_actual) + 1, 8, '0', STR_PAD_LEFT);
            $voucher->numero_actual = $numero_comprobante;
            $voucher->save();
            $fecha = date("Y-m-d H:i:s");
            $id_venta = '';
            if ($id_cliente != '') {
                $id_venta = Sale::create([
                    'tipo_comprobante' => $tipo_comprobante,
                    'serie_comprobante' => $serie_comprobante,
                    'numero_comprobante' => $numero_comprobante,
                    'fecha_hora_emision' => $fecha,
                    'id_usuario' => Auth::user()->id,
                    'id_cliente' => $id_cliente
                    ])->id;
            } else {
                $id_venta = Sale::create([
                    'tipo_comprobante' => $tipo_comprobante,
                    'serie_comprobante' => $serie_comprobante,
                    'numero_comprobante' => $numero_comprobante,
                    'fecha_hora_emision' => $fecha,
                    'id_usuario' => Auth::user()->id,
                    ])->id;
            }
            // Detalle
            foreach ($detalle_venta as $producto) {
                $id = $producto["item"]["id"];
                $descripcion = $producto["item"]["descripcion_corta"];
                $precio = $producto["item"]["precio_venta"];
                SaleDetail::create([
                    'id_venta' => $id_venta,
                    'id_producto' => $id,
                    'descripcion_corta' => $descripcion,
                    'cantidad' => 1,
                    'precio_unitario' => $precio,
                    'precio_total' => $precio
                    ]);
            }
            // Otros Montos
            $igv = $total * 0.18;
            $sub_total = $total - $igv;
            SaleAmounts::create([
                'id_venta' => $id_venta,
                'efectivo' => $efectivo,
                'sub_total' => $sub_total,
                'igv' => $igv,
                'total' => $total
                ]);
            // Sesión de caja
            $sesion = SaleSession::recuperarSesion(Auth::user()->id);
            $sesion->ingresos = floatval($sesion->ingresos) + $total;
            $sesion->monto_actual = floatval($sesion->monto_inicial) + floatval($sesion->ingresos) - floatval($sesion->egresos);
            $sesion->save();

            DB::commit();

            // --- Retornar la ruta para imprimir el comprobante
            $ruta = '/ventas/punto_de_venta/ticket/' . $id_venta;
            $mensaje = 'Venta Realizada';
            $resultado = true;
        } catch(\Exception $e){
            DB::rollback();
            $mensaje = $e->getMessage();
        }
        // Finalizar
        return response()->json([
            'resultado' => $resultado,
            'mensaje' => $mensaje,
            'ruta' => $ruta,
            ]);
    }

    /**
     * Imprimir ticket de venta
     */
    public function imprimirTicket($id_venta) {
        $configuracion = BusinessConfig::find(1);
        $razon_social = $configuracion->razon_social;
        $ruc = $configuracion->ruc;
        $direccion = $configuracion->direccion;
        $venta = Sale::find($id_venta);
        $fecha_emision = $venta->fecha_hora_emision;
        $comprobante = $venta->numero_comprobante;
        $cliente = Customer::find($venta->id_cliente);
        $cliente_numero_documento = '';
        $cliente_razon_social = '';
        if ($cliente) {
            $cliente_numero_documento = $cliente->numero_documento;
            $cliente_razon_social = $cliente->razon_social;
        }
        $productos = SaleDetail::where('id_venta', '=', $id_venta)->get();
        //$montos = SaleAmounts::find($id_venta);
        $montos = SaleAmounts::where('id_venta', '=', $id_venta)->first();
        // Validar para boletas o facturas
        if ($venta->tipo_comprobante == 'boleta') {
            return view('ventas.ticket', compact('razon_social', 'ruc', 'direccion', 'fecha_emision', 'comprobante', 'cliente_numero_documento', 'cliente_razon_social', 'productos', 'montos'));
        } else {
            return view('ventas.ticket_factura', compact('razon_social', 'ruc', 'direccion', 'fecha_emision', 'comprobante', 'cliente', 'productos', 'montos'));
        }
    }

    /**
     * Recuperar datos de un cliente a partir del número de documento
     */
    public function recuperarCliente($numero_documento = '') {
       return Customer::where('numero_documento', $numero_documento)
                      ->select('nombre_razon_social','numero_documento', 'direccion')
                      ->first();
    }
}
