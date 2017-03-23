@extends('layouts.dashboard')

@section('title')
  Administrar Usuarios
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('bower_resources/bootstrap-sweetalert/dist/sweetalert.css') }}">
@endsection

@section('content')
  <div ng-app="administrarUsuarios" ng-controller="usuariosController">
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
              <a href="{{ url('admin/usuarios', $usuario->id) }}" class="btn-flat btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="material-icons">mode_edit</i></a>
              <button class="btn-danger btn-xs btn-no-border waves-effect" ng-click="confirmarEliminacion({{ $usuario->id }})"><i class="material-icons">delete</i></button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalConfirmacion" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <p>¿Realmente desea eliminar al usuario?</p>
          </div>
          <div class="modal-footer ob-modal-footer">
            <button type="button" class="btn btn-flat" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" ng-click="eliminarUsuario()">Eliminar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
       $('[data-toggle="tooltip"]').tooltip({animation: true, delay: {show: 150, hide: 150}});
    });
  </script>
  <script src="{{ asset('js/angular.min.js') }}" ></script>
  <script src="{{ asset('bower_resources/bootstrap-sweetalert/dist/sweetalert.min.js') }}" ></script>
  <script src="{{ asset('js/apps/usuarios.administrar.js') }}" ></script>
@endsection
