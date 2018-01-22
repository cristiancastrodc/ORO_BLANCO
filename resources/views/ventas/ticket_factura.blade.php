@extends('layouts.dashboard')

@section('title', 'Ticket Factura')

@section('css')
<link rel="stylesheet" href="{{ asset('css/ticket.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-12 hidden-print">
      <h1>Resumen de la Operación</h1>
      <div class="row">
        <label class="col-sm-2 control-label">RUC:</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{ $cliente->numero_documento }}</p>
        </div>
        <label class="col-sm-2 control-label">Razón Social:</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{ $cliente->nombre_razon_social }}</p>
        </div>
        <label class="col-sm-2 control-label">Dirección:</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{ $cliente->direccion }}</p>
        </div>
        <label class="col-sm-2 control-label">Ticket Nro.:</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{ $serie }} - {{ $comprobante }}</p>
        </div>
        <label class="col-sm-2 control-label">Total:</label>
        <div class="col-sm-10">
          <p class="form-control-static">S/. {{ $montos->total }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('outer-container')
<div class="ticket">
  <h4 class="text-center title">ORO BLANCO </h4>
  <p class="text-center big">Pasteleria</p>
  <p class="text-center"><small>{{ $razon_social }}</small></p>
  <p class="text-center">RUC:{{ $ruc }}</p>
  <p class="text-center">{{ $direccion}}</p>
  <p class="text-center">-----------------------------</p>
  <p>{{ $fecha_emision }}</p>
  <p>Ticket Nro.: {{ $serie }} - {{ $comprobante }}</p>
  <p>Nro. Serie: FFCF280715</p>
  <p>RUC:{{ $cliente->numero_documento }}</p>
  <p>Razón Social: {{ $cliente->nombre_razon_social }}</p>
  <p>Dirección: {{ $cliente->direccion }}</p>
  <p class="text-center">=================================</p>
  <table>
    @foreach($productos as $producto)
    <tr>
      <td colspan="2">{{ $producto->descripcion_corta }}</td>
    </tr>
    <tr>
      <td>{{ $producto->cantidad }} x {{ $producto->precio_unitario }}</td>
      <td class="text-right">{{ $producto->precio_total }}</td>
    </tr>
    @endforeach
    <tr>
      <td colspan="2" class="text-right">--------------</td>
    </tr>
    <tr>
      <td>Sub_Total </td>
      <td class="text-right">{{ $montos->sub_total }}</td>
    </tr>
    <tr>
      <td>I.G.V. </td>
      <td class="text-right">{{ $montos->igv }}</td>
    </tr>
    <tr>
      <td colspan="2">- - - - - - - - - - - - - - -</td>
    </tr>
    <tr>
      <td>Total </td>
      <td class="text-right">S/. {{ $montos->total }}</td>
    </tr>
    <tr>
      <td>Efectivo </td>
      <td class="text-right">{{ $montos->efectivo }}</td>
    </tr>
    <tr>
      <td>Vuelto </td>
      <td class="text-right">{{ number_format(($montos->efectivo - $montos->total), 2) }}</td>
    </tr>
  </table>
</div>
@endsection

@section('scripts')
<script>
  window.onload = function() { window.print(); }
</script>
@endsection
