<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
}
