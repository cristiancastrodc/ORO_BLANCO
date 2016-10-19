<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sale;
use App\Category;
use App\Product;
use App\SaleAmounts;
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
    /**
     * Filtros para el Estadistico de Ventas.
     */
    public function filtrarEstadisticoVentas()
    {
        return view('admin.reports.sales_statistics.filter');
    }
    /**
     * Generar el Estadistico de Ventas.
     */
    public function generarEstadisticoVentas(Request $request)
    {
        $fecha_inicial = $request['fechaInicial'];
        $fecha_final = $request['fechaFinal'];
        $intervalo = $request['selIntervalo'];

        $ventas = Sale::estadisticoVentas($fecha_inicial, $fecha_final, $intervalo);

        return view('admin.reports.sales_statistics.result', ['ventas' => $ventas]);
    }
    /**
     * Filtros para el Estadistico de Productos.
     */
    public function filtrarEstadisticoProductos()
    {
        $categorias = Category::all();
        return view('admin.reports.product_statistics.filter', compact('categorias'));
    }
    /**
     * Generar el Estadistico de Productos.
     */
    public function generarEstadisticoProductos(Request $request)
    {
        $fecha_inicial = $request['fechaInicial'];
        $fecha_final = $request['fechaFinal'];
        $categoria = $request['selCategoria'];

        $productos = Sale::estadisticoProductos($fecha_inicial, $fecha_final, $categoria);

        $nom_fecha = '';
        if ($fecha_inicial == $fecha_final) {
            $nom_fecha = 'Fecha';
            $fechas = $fecha_inicial;
        }else {
            $nom_fecha = 'Fechas';
            $fechas = 'Del ' . $fecha_inicial  . ' al ' . $fecha_final;
        }

        return view('admin.reports.product_statistics.result',
            ['productos' => $productos, 'nom_fecha' => $nom_fecha, 'fechas' => $fechas,]);
    }
    /**
     * Filtros para el Resumen de Ventas.
     */
    public function filtrarResumenVentas()
    {
        return view('admin.reports.sales_summary.filter');
    }    
    /**
     * Generar el Estadistico de Ventas.
     */
    public function generarResumenVentas(Request $request)
    {
        $fecha_inicial = $request['fechaInicial'];
        $fecha_final = $request['fechaFinal'];

        $ventas = Sale::resumenVentas($fecha_inicial, $fecha_final);        

        return view('admin.reports.sales_summary.result', ['ventas' => $ventas]);
    }
}
