<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Sale extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo_comprobante', 'serie_comprobante', 'numero_comprobante', 'fecha_hora_emision', 'id_usuario', 'id_cliente', 'esta_anulada'];

    /**
     * Devuelve la lista de ventas para el reporte de Ventas.
     */
    public static function reporteVentas($fecha_inicial, $fecha_final)
    {
        return Sale::join('users', 'id_usuario', '=', 'users.id')
                   ->leftJoin('customers', 'id_cliente', '=', 'customers.id')
                   ->join('sale_details', 'sales.id', '=', 'sale_details.id_venta')
                   ->join('sale_amounts', 'sales.id', '=', 'sale_amounts.id_venta')
                   ->whereDate('fecha_hora_emision', '>=', $fecha_inicial)
                   ->whereDate('fecha_hora_emision', '<=', $fecha_final)
                   ->groupBy('sale_details.id_venta')
                   ->select('sales.id', 'fecha_hora_emision', DB::raw("CONCAT(users.nombres, ' ', users.apellidos) as usuario"), DB::raw("CONCAT(sales.tipo_comprobante, ' ', sales.serie_comprobante, '-', sales.numero_comprobante) as comprobante"), 'nombre_razon_social', DB::raw('SUM(sale_details.cantidad) as cantidad'), 'sub_total', 'igv', 'total', 'efectivo')
                   ->get();
    }
}
