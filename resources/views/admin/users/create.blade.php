@extends('layouts.dashboard')

@section('title')
  Crear Usuario
@endsection

@section('content')
  <div class="col-sm-8">
    <h2 class="font-main-color">Crear Usuario</h2>
    <form class="form-horizontal" method="POST" action="{{ url('/admin/usuarios') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label for="tbUser" class="col-sm-2 control-label">Usuario:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tbUser" name="tbUser" placeholder="Usuario">
          <span class="help-block">Ingrese el usuario para el inicio de sesión.</span>
        </div>
      </div>
      <div class="form-group">
        <label for="tbPassword" class="col-sm-2 control-label">Contraseña:</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="tbPassword" name="tbPassword" placeholder="Contraseña">
        </div>
      </div>
      <div class="form-group">
        <label for="tbDNI" class="col-sm-2 control-label">DNI:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tbDNI" name="tbDNI" placeholder="DNI">
        </div>
      </div>
      <div class="form-group">
        <label for="tbFirstName" class="col-sm-2 control-label">Nombres:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tbFirstName" name="tbFirstName" placeholder="Nombres">
        </div>
      </div>
      <div class="form-group">
        <label for="tbLastName" class="col-sm-2 control-label">Apellidos:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tbLastName" name="tbLastName" placeholder="Apellidos">
        </div>
      </div>
      <div class="form-group">
        <label for="selRole" class="col-sm-2 control-label">Rol:</label>
        <div class="col-sm-10">
          <select class="form-control" id="selRole" name="selRole">
            <option value="admin">Administrador</option>
            <option value="ventas">Ventas</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="estado" class="col-sm-2 control-label">Estado:</label>
        <div class="col-sm-10">
          <div class="radio">
            <label>
              <input type="radio" name="estado" id="estadoHabilitado" value="1" checked>
              Habilitado
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="estado" id="estadoInhabilitado" value="0">
              Inhabilitado
            </label>
          </div>
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
