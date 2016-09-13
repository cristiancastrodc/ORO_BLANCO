@extends('layouts.dashboard')

@section('title')
  Configurar Empresa
@endsection

@section('content')
  <div class="col-sm-8">
    <h1>Configurar Datos de Empresa</h1>
    <form class="form-horizontal" method="POST" action="{{ url('/admin/business_config') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label for="tbRuc" class="col-sm-2 control-label">RUC:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tbRuc" name="tbRuc" placeholder="RUC" maxlength="11" value="{{ $ruc }}">
        </div>
      </div>
      <div class="form-group">
        <label for="tbRazon_Social" class="col-sm-2 control-label">Razon Social:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tbRazon_Social" name="tbRazon_Social" placeholder="Razon Social" value="{{ $razon_social }}">
        </div>
      </div>
      <div class="form-group">
        <label for="tbDireccion" class="col-sm-2 control-label">Direccion:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tbDireccion" name="tbDireccion" placeholder="Direccion" value="{{ $direccion }}">
        </div>
      </div>
      <div class="form-group">
        <label for="tbTelefono" class="col-sm-2 control-label">Telefono:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tbTelefono" name="tbTelefono" placeholder="Telefono" value="{{ $telefono }}">
        </div>
      </div>
      <div class="form-group">
        <label for="tbEslogan" class="col-sm-2 control-label">Eslogan:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tbEslogan" name="tbEslogan" placeholder="Eslogan" value="{{ $eslogan }}">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </form>
  </div>
@endsection
