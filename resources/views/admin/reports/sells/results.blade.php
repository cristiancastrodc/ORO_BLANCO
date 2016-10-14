@extends('layouts.dashboard')

@section('title')
  Reporte de Ventas
@endsection

@section('content')
  <div class="col-sm-8">
    <h2 class="font-main-color">Reporte de Ventas</h2>
    {{ $fecha }}
  </div>
@endsection
