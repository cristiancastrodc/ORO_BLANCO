@extends('layouts.dashboard')

@section('title')
  Reportes
@endsection

@section('content')
  <div class="col-sm-8">
    <h2 class="font-main-color">Reportes</h2>
    <div class="collection">
      <a href="{{ url('/admin/reportes/ventas/filtrar') }}" class="collection-item font-accent-color">Ventas</a>
      <a href="#!" class="collection-item font-accent-color">Estadístico de Ventas</a>
      <a href="#!" class="collection-item font-accent-color">Estadístico de Productos</a>
      <a href="#!" class="collection-item font-accent-color">Resumen de Ventas</a>
    </div>
  </div>
@endsection