@extends('layouts.dashboard')

@section('title')
  Ticket
@endsection
@section('content')
  <style>
  .ticket {
    font-family: monospace;
  }
  p {
    margin-bottom: 0;
  }
  h4{
    margin-bottom: 0;
  }
  @media print {
    .ticket {
      font-size: 10px;
    }
    p {
      margin-bottom: 0;
    }
  }
  </style>
  <div class="container">
    <div class="row">
      <div class="ticket visible-print-block">
        <div class="col-sm-4 col-sm-offset-4">
          <h4 class="text-center">ORO BLANCO </h4>
          <p class="text-center">Pasteleria</p>
          <p class="text-center"><small>{{ $razon_social }}</small></p>
          <p class="text-center">RUC:{{ $ruc }}</p>
          <p class="text-center">{{ $direccion}}</p>
          <p class="text-center">-----------------------------</p>
          <p>{{ $fecha_emision }}</p>
          <p>Ticket Nro.: {{ $comprobante }}</p>
          <p>Nro. Serie: FFCF280715</p>
          <p>Nro. Documento:{{ $cliente_numero_documento }}</p>
          <p>Cliente: {{ $cliente_razon_social }}</p>
          <p class="text-center">=================================</p>
        </div>
        <div class="col-sm-4 col-sm-offset-4">
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
              <td colspan="2">- - - - - - - - - - - - - - - - -</td>
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
      </div>
      <div class="col-sm-12 hidden-print">
        <h1>Resumen de la Operación</h1>
        <div class="row">
          <label class="col-sm-2 control-label">Nro. Documento:</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $cliente_numero_documento }}</p>
          </div>
          <label class="col-sm-2 control-label">Cliente:</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $cliente_razon_social }}</p>
          </div>
          <label class="col-sm-2 control-label">Ticket Nro.:</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $comprobante }}</p>
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

@section('scripts')
  <script>
    window.onload = function() { window.print(); }
  </script>
@endsection
