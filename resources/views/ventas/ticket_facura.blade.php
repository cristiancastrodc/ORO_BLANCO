@extends('layouts.dashboard')

@section('title')
  Ticket Factura
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
          <p class="text-center">=================================</p>
          <p class="text-center">{{ $fecha_emision }}</p>
          <p class="text-center">Ticket Nro.: {{ $comprobante }}</p>
          <p class="text-center">Nro. Serie: FFCF280715</p>
          <p class="text-center">RUC:{{ $cliente->numero_documento }}</p>
          <p class="text-center">Razon Social: {{ $cliente->razon_social }}</p>
          <p class="text-center">Direccion: {{ $cliente->direccion }}</p>
          <p class="text-center">=================================</p>
        </div>
        <div class="col-sm-4 col-sm-offset-4">
          <table>
            @foreach($productos as $producto)
            <tr>
              <td colspan="3">{{ $producto->descripcion_corta }}</td>
            </tr>
            <tr>
              <td>{{ $producto->cantidad }} x</td>
              <td>{{ $producto->precio_unitario }}</td>
              <td>{{ $producto->precio_total }}</td>            
            </tr>
            @endforeach 
            <tr>
              <td>- - - - - - - - - - - - - - - - -</td>
            </tr>         
            <tr>
              <td colspan="2">Sub_Total </td>
              <td colspan="1">{{ $montos->subtotal }}</td>
            </tr>
            <tr>
              <td colspan="2">I.G.V. </td>
              <td>{{ $montos->igv }}</td>
            </tr>
            <tr>
              <p>- - - - - - - - - - - - - - - - -</p>
            </tr>
            <tr>
              <td colspan="2">Total </td>
              <td colspan="1">{{ $montos->total }}</td>
            </tr>
            <tr>
              <td colspan="2">Efectivo </td>
              <td colspan="1">{{ $montos_efectivo }}</td>
            </tr>
            <tr>
              <td colspan="2">Vuelto </td>
              <td colspan="1">{{ $montos->efectivo - $montos->total }}</td>
            </tr>
          </table>
        </div> 
      </div>
      <div class="hidden-print"> 
        <h1>Resumen de la Operación</h1>
          <div >
            <label class="col-sm-2 control-label">RUC:</label>
            <div class="col-sm-10">
              <p class="form-control-static">{{ $cliente->numero_documento }}</p>
            </div>
            <label class="col-sm-2 control-label">Razon Social:</label>
            <div class="col-sm-10">
              <p class="form-control-static">{{ $cliente->razon_social }}</p>
            </div>
            <label class="col-sm-2 control-label">Direccion:</label>
            <div class="col-sm-10">
              <p class="form-control-static">{{ $cliente->direccion }}</p>
            </div>
            <label class="col-sm-2 control-label">Ticket Nro.:</label>
            <div class="col-sm-10">
              <p class="form-control-static">{{ $comprobante }}</p>
            </div>
            <label class="col-sm-2 control-label">Total:</label>
            <div class="col-sm-10">
              <p class="form-control-static">S/. {{ $total }}</p>
            </div>            
          </div>         
      </div>
    </div>
  </div>
</body>
</html>
