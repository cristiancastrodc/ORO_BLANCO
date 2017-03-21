@extends('layouts.dashboard')

@section('title')
  Administrar Usuarios
@endsection

@section('content')
  <div class="col-sm-8">
    <h2 class="font-main-color">Administrar Usuarios <a href="{{ url('/admin/usuarios/create') }}" class="btn main-color btn-sm btn-ob waves-effect waves-light">Nuevo Usuario</a></h2>

    <table class="table table-hover">
      <thead>
        <tr>
          <th>Usuario</th>
          <th>DNI</th>
          <th>Nombre</th>
          <th>Tipo</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($usuarios as $usuario)
        <tr>
          <td>{{ $usuario->user }}</td>
          <td>{{ $usuario->dni }}</td>
          <td>{{ $usuario->nombres }} {{ $usuario->apellidos }}</td>
          <td>{{ $usuario->tipo }}</td>
          <td>
            <a href="{{ url('admin/usuarios', $usuario->id) }}" class="btn-flat" data-toggle="tooltip" data-placement="top" title="Editar"><i class="material-icons">mode_edit</i></a>
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