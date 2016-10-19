<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sale;
use App\SaleDetail;

class ReportsAdminController extends Controller
{
    /**
     * Report listing.
     */
    public function listadoReportes()
    {
        return view('admin.reports.index');
    }
    /**
     * Filtros para el Reporte de Ventas.
     */
    public function filtrarReporteVentas()
    {
        return view('admin.reports.sells.filter');
    }
    /**
     * Generar el Reporte de Ventas.
     */
    public function generarReporteVentas(Request $request)
    {
        $fecha = date('d-m-y h:i:s');

        $fecha_inicial = $request['fechaInicial'];
        $fecha_final = $request['fechaFinal'];

        $ventas = Sale::reporteVentas($fecha_inicial, $fecha_final);

        $nro_ventas = 0;
        $monto_total = 0;
        foreach ($ventas as $venta) {
            $nro_ventas++;
            $monto_total += $venta->total;
        }
        $monto_total = number_format($monto_total, 2);

        $nom_fecha = '';
        if ($fecha_inicial == $fecha_final) {
            $nom_fecha = 'Fecha';
            $fechas = $fecha_inicial;
        }else {
            $nom_fecha = 'Fechas';
            $fechas = 'Del ' . $fecha_inicial  . ' al ' . $fecha_final;
        }

        return view('admin.reports.sells.results',
            ['ventas' => $ventas, 'nro_ventas' => $nro_ventas, 'monto_total' => $monto_total, 'fechas' => $fechas, 'fecha' => $fecha, 'nom_fecha' => $nom_fecha]);
    }
    /**
     * Recuperar el detalle de una venta para el reporte.
     */
    public function detalleVentas($id_venta)
    {
        return SaleDetail::where('id_venta', $id_venta)
                         ->select('descripcion_corta', 'cantidad', 'precio_unitario', 'precio_total')
                         ->get();
    }
}
