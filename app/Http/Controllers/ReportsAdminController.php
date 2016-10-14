<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sale;

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

        return view('admin.reports.sells.results',
            ['ventas' => $ventas, 'nro_ventas' => $nro_ventas, 'monto_total' => $monto_total, 'fecha_inicial' => $fecha_inicial, 'fecha_final' => $fecha_final, 'fecha' => $fecha]);
    }
}
