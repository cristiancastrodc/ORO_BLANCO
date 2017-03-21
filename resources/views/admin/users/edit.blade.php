@extends('layouts.dashboard')

@section('title')
  Editar Usuario
@endsection

@section('content')
  <div class="col-sm-8">
    <h2 class="font-main-color">Editar Usuario</h2>
    <form class="form-horizontal" method="POST" action="{{ url('admin/usuario/actualizar', $usuario->id) }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label for="tbUser" class="col-sm-2 control-label">Usuario:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tbUser" name="tbUser" placeholder="Usuario" value="{{ $usuario->user }}" autocomplete="off">
          <span class="help-block">Ingrese el usuario para el inicio de sesión.</span>
        </div>
      </div>
      <div class="form-group">
        <label for="tbDNI" class="col-sm-2 control-label">DNI:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tbDNI" name="tbDNI" placeholder="DNI" value="{{ $usuario->dni }}">
        </div>
      </div>
      <div class="form-group">
        <label for="tbFirstName" class="col-sm-2 control-label">Nombres:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tbFirstName" name="tbFirstName" placeholder="Nombres" value="{{ $usuario->nombres }}">
        </div>
      </div>
      <div class="form-group">
        <label for="tbLastName" class="col-sm-2 control-label">Apellidos:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tbLastName" name="tbLastName" placeholder="Apellidos" value="{{ $usuario->apellidos }}">
        </div>
      </div>
      <div class="form-group">
        <label for="selRole" class="col-sm-2 control-label">Rol:</label>
        <div class="col-sm-10">
          <select class="form-control" id="selRole" name="selRole">
            <option value="admin" @if($usuario->tipo == 'admin') selected="" @endif>Administrador</option>
            <option value="ventas" @if($usuario->tipo == 'ventas') selected="" @endif>Ventas</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary main-color btn-ob waves-effect waves-light">Guardar</button>
        </div>
      </div>
    </form>
  </div>
@endsection
