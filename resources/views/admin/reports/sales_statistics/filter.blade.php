@extends('layouts.dashboard')

@section('title')
  Reportes
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/bootstrap-material-datetimepicker.css') }}">
@endsection

@section('content')
  <div class="col-sm-8">
    <h2 class="font-main-color">Estadistico de Ventas</h2>
    <form class="form-horizontal" method="POST" action="{{ url('/admin/reportes/estadistico_ventas/generar') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label for="fechaInicial" class="col-sm-2 control-label">Fecha Inicial:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control datepicker initial-date" id="fechaInicial" name="fechaInicial" placeholder="Fecha Inicial">
        </div>
      </div>
      <div class="form-group">
        <label for="fechaFinal" class="col-sm-2 control-label">Fecha Final:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control datepicker final-date" id="fechaFinal" name="fechaFinal" placeholder="Fecha Final">
        </div>
      </div>
      <div class="form-group">
        <label for="selIntervalo" class="col-sm-2 control-label">Intervalo de tiempo:</label>
          <div class="col-sm-10">
            <select class="form-control" name="selIntervalo">
              <option value="1">Cada una hora</option>
              <option value="2">Cada dos horas</option>
              <option value="3">Cada tres horas</option>
            </select>
          </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn main-color btn-ob waves-effect waves-light">Generar</button>
        </div>
      </div>
    </form>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/moment-with-locales.js') }}"></script>
  <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}"></script>
  <script src="{{ asset('js/local.js') }}"></script>
@endsection