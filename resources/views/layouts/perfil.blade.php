@extends('layouts.dashboard')

@section('title')
  Cambiar Contraseña
@endsection

@section('content')
  <div class="col-sm-8">
    <h1>Cambiar Contraseña</h1>
    <form class="form-horizontal" method="POST" action="{{ url('/perfil_config') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label for="tbNombre" class="col-sm-2 control-label">Nombre:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tbNombre" name="tbNombre" value="{{ $nombre }} {{ $apellidos }}">
        </div>
      </div>
      <div class="form-group">
        <label for="tbPassword" class="col-sm-2 control-label">Contraseña Nueva:</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="tbPassword" name="tbPassword" placeholder="Contraseña Nueva">
        </div>
      </div>      
      <div class="form-group">
        <label for="tbContrasenia" class="col-sm-2 control-label">Contraseña Actual:</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="tbContrasenia" name="tbContrasenia" placeholder="Contraseña Actual">
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
