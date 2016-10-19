@extends('layouts.dashboard')

@section('title')
  Reporte de Estadístico de Productos
@endsection

@section('content')
  <div class="col-sm-8">
    <h2 class="font-main-color">Reporte de Estadístico de Productos</h2>
    <div class="form-group">
      <label class="col-sm-2 control-label">{{ $nom_fecha }}:</label>
      <div class="col-sm-10">
        <p class="form-control-static">{{ $fechas }}</p>
      </div>
    </div>
    <div class="form-group">
      <table class="table">
        <tr>
          <td>Codigo Producto</td>
          <td>Descripcion Producto</td>
          <td>Precio Actual</td>
          <td>Cant. Vendidas</td>
          <td>Total (S/)</td>
        </tr>
        @foreach($productos as $producto)
        <tr>
          <td>{{ $producto->codigo }}</td>
          <td>{{ $producto->descripcion }}</td>
          <td class="text-right">{{ $producto->precio_venta }}</td>
          <td class="text-right">{{ $producto->cantidad }}</td>
          <td class="text-right">{{ $producto->total }}</td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection
