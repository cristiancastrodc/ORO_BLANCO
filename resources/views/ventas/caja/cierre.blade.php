@extends('layouts.dashboard')

@section('title')
  Cierre de Caja
@endsection

@section('content')
  <div class="col-sm-12">
    <h2>Cierre de Caja</h2>
    <form class="form-horizontal" method="POST" action="{{ url('/ventas/cerrar') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary" id="btCierre_caja">Confirmar Cierre de Caja</button>
      </div>
    </form>
  </div>
@endsection
