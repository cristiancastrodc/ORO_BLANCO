@extends('layouts.dashboard')

@section('title')
  Administrar Productos
@endsection
@section('css')
  <link rel="stylesheet" href="{{ asset('bower_resources/bootstrap-sweetalert/dist/sweetalert.css') }}">
@endsection

@section('content')
<div ng-app="administrarProductos" ng-controller="productosController">
  <div class="col-sm-12">
    <h2 class="font-main-color">Administrar Productos</h2>
    <div class="checkbox">
      <label>
        <input type="checkbox" ng-model="estado" ng-change="filtrarProductos(estado)" ng-true-value="1" ng-false-value="0">
        Mostrar sólo productos habilitados.
      </label>
    </div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Código</th>
          <th>Descripción</th>
          <th>Descripción Corta</th>
          <th>Precio de Venta</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="producto in productos">
          <td>{@ producto.codigo @}</td>
          <td class="text-uppercase">{@ producto.descripcion @}</td>
          <td class="text-uppercase">{@ producto.descripcion_corta @}</td>
          <td class="text-right">{@ producto.precio_venta @}</td>
          <td>{@ producto.estado == 1? 'Habilitado' : 'Inhabilitado' @}</td>
          <td>
            <a ng-href="/admin/productos/{@ producto.id @}" class="btn-flat btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="material-icons">mode_edit</i></a>
            <button class="btn-danger btn-xs btn-no-border waves-effect" ng-click="confirmarEliminacion(producto.id)"><i class="material-icons">delete</i></button>
          </td>
        </tr>
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
          <p>¿Realmente desea eliminar el producto?</p>
        </div>
        <div class="modal-footer ob-modal-footer">
          <button type="button" class="btn btn-flat" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" ng-click="eliminarProducto()">Eliminar</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $(document).ready(function(){
     $('[data-toggle="tooltip"]').tooltip({animation: true, delay: {show: 300, hide: 300}});
  });
</script>
<script src="{{ asset('js/angular.min.js') }}" ></script>
  <script src="{{ asset('bower_resources/bootstrap-sweetalert/dist/sweetalert.min.js') }}" ></script>
  <script src="{{ asset('js/apps/productos.administrar.js') }}" ></script>
@endsection