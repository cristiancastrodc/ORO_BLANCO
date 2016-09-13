@extends('layouts.dashboard')

@section('title')
  Resumen de la Sesión
@endsection

@section('content')
  <div class="col-sm-12">
    <h1>Resumen de la Sesión</h1>
    <div class="row">
      <div class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label">Usuario:</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $nombre }}</p>
          </div>          
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Hora de Apertura:</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $sesion->fecha_hora_inicio }}</p>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Hora de Cierre:</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $sesion->fecha_hora_fin }}</p>
          </div>          
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Monto Inicial:</label>
          <div class="col-sm-10">
            <p class="form-control-static">S/. {{ $sesion->monto_inicial }}</p>
          </div>          
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Ingresos:</label>
          <div class="col-sm-10">
            <p class="form-control-static">S/. {{ $sesion->ingresos }}</p>
          </div>          
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Egresos:</label>
          <div class="col-sm-10">
            <p class="form-control-static">S/. {{ $sesion->egresos }}</p>
          </div>          
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Saldo:</label>
          <div class="col-sm-10">
            <p class="form-control-static">S/. {{ $sesion->monto_actual }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
