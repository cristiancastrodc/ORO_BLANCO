@extends('layouts.dashboard')

@section('title')
  Apertura de Caja
@endsection

@section('content')
  <div class="col-sm-8">
    <h1>Apertura de Caja</h1>
    <form class="form-horizontal" method="POST" action="{{ url('/ventas/sesion') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label for="tbMontoInicial" class="col-sm-4 control-label">Ingrese el monto de apertura:</label>
        <div class="col-sm-8">
          <div class="input-group">
            <div class="input-group-addon">S/</div>
            <input type="text" class="form-control" id="tbMontoInicial" name="tbMontoInicial" placeholder="Monto">
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-10">
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </form>
  </div>
@endsection
