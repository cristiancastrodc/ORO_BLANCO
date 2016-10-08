@extends('layouts.dashboard')

@section('title')
  Crear Categoría
@endsection

@section('content')
  <div class="col-sm-8">
    <h2 class="font-main-color">Crear Categoría</h2>
    <form class="form-horizontal" method="POST" action="{{ url('/admin/categorias') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label for="nombre" class="col-sm-2 control-label">Categoría:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
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
