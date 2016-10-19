@extends('layouts.dashboard')

@section('title')
  Estadistico de Ventas
@endsection

@section('content')
  <div class="col-sm-8">
    <h2 class="font-main-color">Estadistico de Ventas</h2>    
    <div class="form-group">
      <table class="table">
        <tr>
          <td>Rango de Tiempo</td>
          <td>Cantidad Transacciones</td>
          <td>Total (S/)</td>
        </tr>
        @foreach($ventas as $venta)
        <tr>
          <td>{{ $venta->rango_inicio }} - {{ $venta->rango_fin }}</td>
          <td>{{ $venta->cantidad }}</td>
          <td class="text-right">{{ $venta->total }}</td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection
