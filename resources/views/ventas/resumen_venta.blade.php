@extends('layouts.dashboard')

@section('title')
  Resumen de Ventas
@endsection

@section('content')
  <div class="col-sm-8">
    <h2 class="font-main-color">Resumen de Ventas</h2>
    <table class="table">
      <tr>
        <td>Ticket</td>
        <td>Hora Emision</td>
        <td>Ver</td>
      </tr>
      @foreach($venta as $venta)
      <tr>
        <td>{{ $venta->serie_comprobante }} - {{ $venta->numero_comprobante }}</td>
        <td>{{ $venta->fecha_hora_emision }}</td>
        <td>
          <a href="{{ url('ventas/detalle', [$venta->id]) }}"><i class="material-icons">receipt</i></a>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
@endsection

