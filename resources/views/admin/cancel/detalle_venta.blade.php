@extends('layouts.dashboard')

@section('title')
  Venta
@endsection

@section('content')
  <div class="col-sm-8">
    <h2 class="font-main-color">Venta</h2>
    <form class="form-horizontal" method="POST" action="{{ url('/admin/anular') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="tbTicket" value="{{ $id_ticket->numero_comprobante }}">
      <div class="form-horizontal">
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
          <label class="col-sm-2 control-label">Usuario:</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $usunombre }}</p>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Cliente:</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $nombre }}</p>
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
          <div class="col-sm-10">
            <table class="table">
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
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn main-color btn-ob waves-effect waves-light">Anular</button>
          </div>
        </div>
      </div>
    </div>
    </form>
  </div>
@endsection
