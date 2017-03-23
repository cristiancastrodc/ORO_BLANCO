@extends('layouts.dashboard')

@section('title')
  Crear Producto
@endsection

@section('content')
  <div class="col-sm-8">
    <h2 class="font-main-color">Crear Producto</h2>
    <form class="form-horizontal" method="POST" action="{{ url('/admin/productos') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label for="tbCodigo" class="col-sm-2 control-label">Código:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tbCodigo" name="tbCodigo" placeholder="Código de Producto">
        </div>
      </div>
      <div class="form-group">
        <label for="tbDescripcion" class="col-sm-2 control-label">Descripción:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tbDescripcion" name="tbDescripcion" placeholder="Descripcion">
        </div>
      </div>
      <div class="form-group">
        <label for="tbDescripcionCorta" class="col-sm-2 control-label">Descripción Corta:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tbDescripcionCorta" name="tbDescripcionCorta" placeholder="Descripción Corta"  maxlength="30">
          <span class="help-block">La Descripcion Corta se mostrará en el ticket (max. 30 caracteres).</span>
        </div>
      </div>
      <div class="form-group">
        <label for="tbPrecio" class="col-sm-2 control-label">Precio:</label>
        <div class="col-sm-10 input-field">
          <span class="prefix">S/ </span>
          <input type="text" class="form-control" id="tbPrecio" name="tbPrecio" placeholder="Precio">
        </div>
      </div>
      <div class="form-group">
        <label for="selCategoria" class="col-sm-2 control-label">Categoria:</label>
        <div class="col-sm-10 input-field">
          <select class="form-control" id="selCategoria" name="selCategoria">
            <option></option>
            @foreach($categorias as $categoria)
              <option value="{{ $categoria->id }}">{{$categoria->nombre}}</option>
            @endforeach
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
          <button type="submit" class="btn main-color btn-ob waves-effect waves-light">Guardar</button>
        </div>
      </div>
    </form>
  </div>
@endsection
