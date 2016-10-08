@extends('layouts.dashboard')

@section('title')
  Editar Producto
@endsection

@section('content')
  <div class="col-sm-8">
    <h2 class="font-main-color">Editar Producto</h2>
    <form class="form-horizontal" method="POST" action="{{ url('admin/producto/actualizar', $producto->id) }}">
      <input type="hidden" value="{{ csrf_token() }}" id="_token" name="_token">
      <div class="form-group">
        <label for="tbCodigo" class="col-sm-2 control-label">Código:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tbCodigo" name="tbCodigo" placeholder="Código de Producto" value="{{ $producto->codigo }}">
        </div>
      </div>
      <div class="form-group">
        <label for="tbDescripcion" class="col-sm-2 control-label">Descripción:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control text-uppercase" id="tbDescripcion" name="tbDescripcion" placeholder="Descripcion" value="{{ $producto->descripcion }}">
        </div>
      </div>
      <div class="form-group">
        <label for="tbDescripcionCorta" class="col-sm-2 control-label">Descripción Corta:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control text-uppercase" id="tbDescripcionCorta" name="tbDescripcionCorta" placeholder="Descripción Corta" maxlength="30" value="{{ $producto->descripcion_corta }}">
          <span class="help-block">La Descripcion Corta se mostrará en el ticket (max. 30 caracteres).</span>
        </div>
      </div>
      <div class="form-group">
        <label for="tbPrecio" class="col-sm-2 control-label">Precio:</label>
        <div class="col-sm-10 input-field">
          <span class="prefix">S/ </span>
          <input type="text" class="form-control" id="tbPrecio" name="tbPrecio" placeholder="Precio" value="{{ $producto->precio_venta }}">
        </div>
      </div>
      <div class="form-group">
        <label for="selCategoria" class="col-sm-2 control-label">Categoria:</label>
        <div class="col-sm-10 input-field">
          <select class="form-control" id="selCategoria" name="selCategoria">
            @foreach($categorias as $categoria)
              <option value="{{ $categoria->id }}"
                @if($producto->id_categoria == $categoria->id)
                  selected
                @endif
              >{{$categoria->nombre}}</option>
            @endforeach
          </select>
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
