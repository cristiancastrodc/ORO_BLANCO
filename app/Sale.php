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
                   ->select('sales.id', 'fecha_hora_emision', DB::raw("CONCAT(users.nombres, ' ', users.apellidos) as usuario"), DB::raw("CONCAT(sales.tipo_comprobante, ' ', sales.serie_comprobante, '-', sales.numero_comprobante) as comprobante"), 'nombre_razon_social', DB::raw('SUM(sale_details.cantidad) as cantidad'), 'sub_total', 'igv', 'total', 'esta_anulada')
                   ->get();
    }

    /**
     * Devuelve la lista de Productos para el reporte de estadistico de productos.
     */
    public static function estadisticoVentas($fecha_inicial, $fecha_final, $intervalo)
    {
      $valor = intval($intervalo) * 60;
      $sql1 = 'SEC_TO_TIME(TIME_TO_SEC(sales.fecha_hora_emision) - TIME_TO_SEC(sales.fecha_hora_emision) % (' . $valor . ' * 60)) as rango_inicio';
      $sql2 = "ADDTIME(SEC_TO_TIME(TIME_TO_SEC(sales.fecha_hora_emision) - TIME_TO_SEC(sales.fecha_hora_emision) % (" . $valor . " * 60)), '" . $intervalo . ":0:0') as rango_fin";
      return Sale::join('sale_amounts', 'sales.id', '=', 'sale_amounts.id_venta')
                 ->whereDate('fecha_hora_emision', '>=', $fecha_inicial)
                 ->whereDate('fecha_hora_emision', '<=', $fecha_final)
                 ->where('esta_anulada', false)
                 ->select(DB::raw($sql1), DB::raw($sql2), DB::raw('COUNT(*) AS cantidad'), DB::raw('SUM(sale_amounts.total) as total'))
                 ->groupBy('rango_inicio')
                 ->get();
    }


    /**
     * Devuelve la lista de Productos para el reporte de estadistico de productos.
     */
    public static function estadisticoProductos($fecha_inicial, $fecha_final, $categoria)
    {
        return Sale::join('sale_details', 'sales.id', '=', 'sale_details.id_venta')
                   ->join('products', 'sale_details.id_producto', '=', 'products.id')
                   ->whereDate('sales.fecha_hora_emision', '>=', $fecha_inicial)
                   ->whereDate('sales.fecha_hora_emision', '<=', $fecha_final)
                   ->where('products.id_categoria', '=', $categoria)
                   ->where('sales.esta_anulada', false)
                   ->select('products.codigo', 'products.descripcion', 'products.precio_venta', DB::raw('SUM(sale_details.cantidad) as cantidad'), DB::raw('SUM(sale_details.precio_total) as total'))
                   ->groupBy('products.id')
                   ->get();
    }

    /**
     * Devuelve la lista de ventas para el reporte de Resuemen de ventas.
     */
    public static function resumenVentas($fecha_inicial, $fecha_final)
    {
        return Sale::join('sale_amounts', 'sales.id', '=', 'sale_amounts.id_venta')
                   ->whereDate('fecha_hora_emision', '>=', $fecha_inicial)
                   ->whereDate('fecha_hora_emision', '<=', $fecha_final)
                   ->where('esta_anulada', false)
                   ->groupBy(DB::raw('date(fecha_hora_emision)'))
                   ->select(DB::raw('date(fecha_hora_emision) as fecha'), DB::raw('count(sales.id) as cantidad'), DB::raw('SUM(sale_amounts.sub_total) as sub_total'), DB::raw('SUM(sale_amounts.igv) as igv'), DB::raw('SUM(sale_amounts.total) as total'))
                   ->get();
    }
}
