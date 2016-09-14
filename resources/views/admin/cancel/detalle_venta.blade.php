@extends('layouts.dashboard')

@section('title')
  Venta
@endsection

@section('content')
  <div class="col-sm-12">
    <h1>Venta</h1>
    <form class="form-horizontal" method="POST" action="{{ url('/admin/anular') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="row">
      <div class="form-horizontal">
        <input type="hidden" name="tbTicket" value="{{ $id_ticket->numero_comprobante }}">
        <div class="form-group">
          <label class="col-sm-2 control-label">Numero Ticket:</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $id_ticket->serie_comprobante }} - {{ $id_ticket->numero_comprobante }}</p>
          </div>          
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Fecha y Hora de Emision:</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $id_ticket->fecha_hora_emision }}</p>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Cajera:</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $id_ticket->id_usuario }}</p>
          </div>          
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Cliente:</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $id_ticket->id_cliente }}</p>
          </div>          
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Total:</label>
          <div class="col-sm-10">
            <p class="form-control-static">S/. {{ $amounts->total }}</p>
          </div>          
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Detalle:</label>          
        </div>
        <div class="form-group  col-sm-8">
          <table class="table col-sm-offset-3">
            <tr>
              <td>Cant.</td>
              <td>Producto</td>
              <td>Precio</td>
            </tr>
            @foreach($detalle as $producto)
            <tr>
              <td>{{ $producto->cantidad }}</td>
              <td>{{ $producto->descripcion_corta }}</td>              
              <td class="text-right">S/ {{ $producto->precio_total }}</td>
            </tr>
            @endforeach
          </table>                 
        </div>        
        <div class="form-group  col-sm-10">
          <button type="submit" class="btn btn-primary">Anular</button>
        </div>
      </div>
    </div>
    </form>    
  </div>
@endsection
