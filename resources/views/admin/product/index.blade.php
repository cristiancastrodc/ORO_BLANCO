@extends('layouts.dashboard')

@section('title')
  Administrar Productos
@endsection

@section('content')
  <div class="col-sm-8">
    <h2 class="font-main-color">Administrar Productos</h2>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Código</th>
          <th>Descripción</th>
          <th>Descripción Corta</th>
          <th>Precio de Venta</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($productos as $producto)
        <tr>
          <td>{{ $producto->codigo }}</td>
          <td class="text-uppercase">{{ $producto->descripcion }}</td>
          <td class="text-uppercase">{{ $producto->descripcion_corta }}</td>
          <td class="text-right">{{ $producto->precio_venta }}</td>
          <td>
            <a href="{{ url('admin/productos', $producto->id) }}" class="btn-flat" data-toggle="tooltip" data-placement="top" title="Editar"><i class="material-icons">mode_edit</i></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection

@section('scripts')
<script>
  $(document).ready(function(){
     $('[data-toggle="tooltip"]').tooltip({animation: true, delay: {show: 300, hide: 300}});
  });
</script>
@endsection