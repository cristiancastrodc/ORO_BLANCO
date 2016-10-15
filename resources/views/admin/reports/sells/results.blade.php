@extends('layouts.dashboard')

@section('title')
  Reporte de Ventas
@endsection

@section('content')
  <div class="col-sm-12">
    <h2 class="font-main-color">Reporte de Ventas</h2>
    <div class="form-group">
    <label class="col-sm-2 control-label">Número de Ventas:</label>
    <div class="col-sm-10">
   		<p class="form-control-static">{{ $nro_ventas }}</p>
    </div>
    </div>    
    <div class="form-group">
      <label class="col-sm-2 control-label">Monto Total:</label>
      <div class="col-sm-10">
        <p class="form-control-static">S/ {{ $monto_total }}</p>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">{{ $nom_fecha }}:</label>
      <div class="col-sm-10">
        <p class="form-control-static">{{ $fechas }}</p>
      </div>
    </div>
    <div class="form-group">
      <table class="table">
        <tr>
          <td>Fecha</td>
          <td>Vendido Por</td>
          <td>Comprobante</td>
          <td>Cliente</td>
          <td>Cantidad</td>
          <td>Sub Total (S/)</td>
          <td>IGV (S/)</td>
          <td>Total (S/)</td>
          <td>Efectivo (S/)</td>
        </tr>
        @foreach($ventas as $venta)
        <tr>
          <td>{{ $venta->fecha_hora_emision }}</td>
          <td>{{ $venta->usuario }}</td>
          <td>{{ $venta->comprobante }}</td>
          <td>{{ $venta->nombre_razon_social }}</td>
          <td class="text-right">{{ $venta->cantidad }}</td>
          <td class="text-right">{{ $venta->sub_total }}</td>
          <td class="text-right">{{ $venta->igv }}</td>
          <td class="text-right">{{ $venta->total }}</td>
          <td class="text-right">{{ $venta->efectivo }}</td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection
