@extends('layouts.dashboard')

@section('title')
Punto de Venta
@endsection

@section('content')
<div ng-app="puntoDeVenta" data-ng-controller="POSController">
  <div class="col-sm-6">
    <div class="panel">
      <div class="panel-heading main-color font-white">
        <h3 class="panel-title">Venta</h3>
      </div>
      <div class="panel-body">
        <div class="text-warning" ng-hide="order.length">
          Seleccione productos...
        </div>
        <table class="table">
          <tr>
            <td>Borrar</td>
            <td>Producto</td>
            <td>Cantidad</td>
            <td>Precio</td>
          </tr>
          <tr ng-repeat="item in order">
            <td><button class="btn btn-danger btn-xs btn-ob-cancel" ng-click="deleteItem($index)">
              <i class="material-icons">delete</i>
            </button></td>
            <td class="text-uppercase">{@ item.item.descripcion @}</td>
            <td>
              <input type="text" value="{@ item.quantity @}" ng-model="item.quantity" class="text-right table-input">
            </td>
            <td class="text-right"><div class="label label-success ob-labels">S/ {@ item.item.precio_venta @}</div></td>
          </tr>
        </table>
      </div>
      <div class="panel-footer text-right" ng-show="order.length">
        <span class="label label-danger ob-labels">Total: S/ {@ getSum() @}</span>
      </div>
      <div class="panel-footer text-right">
        <span class="btn btn-default" ng-click="clearOrder()" ng-disabled="!order.length">Limpiar</span>
        <button class="btn main-color btn-ob" ng-click="checkout()" ng-disabled="!order.length">Pago</button>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="panel">
      <div class="panel-heading main-color font-white">
        <h3 class="panel-title">Productos</h3>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-12">
            <ul class="list-inline">
              <li ng-repeat="cat in categorias" class="pos-category">
                <a ng-click="asignarCategoria(cat.id)"><span class="label label-ob text-uppercase">{@ cat.nombre @}</span></a>
              </li>
            </ul>
            <a class="btn-flat waves-effect" ng-click="asignarCategoria()">Todas las categorías</a>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group input-field">
              <i class="material-icons prefix">search</i>
              <input type="text" class="form-control" id="tbFiltro" placeholder="Buscar" ng-model="search">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4" ng-repeat="product in products | filter : { descripcion : search} : filtroDescripcion | filter : {id_categoria : categoria} : filtroCategoria">
            <div class="card-panel accent-color text-center text-uppercase products" ng-click="add(product)">
              <span class="white-text">{@ product.descripcion @}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal (Pop up when detail button clicked) -->
  <div class="modal fade" id="modalPago" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="myModalLabel">Finalizar Pago</h4>
        </div>
        <div class="modal-body">
          <form name="fmPago" class="form-horizontal" novalidate="">
            <div class="form-group">
              <label class="col-sm-3 control-label">Comprobante:</label>
              <div class="col-sm-9">
                <label class="radio-inline">
                  <input type="radio" ng-model="comprobante.tipo" name="radComprobante" id="radComprobanteBoleta" value="boleta"> Boleta
                </label>
                <label class="radio-inline">
                  <input type="radio" ng-model="comprobante.tipo" name="radComprobante" id="radComprobanteFactura" value="factura"> Factura
                </label>
              </div>
            </div>
            <div class="form-group">
              <label for="tbNumeroDocumento" class="col-sm-3 control-label">DNI o RUC:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="tbNumeroDocumento" name="tbNumeroDocumento" ng-model="cliente.numero_documento" ng-change="validarDocumento()" ng-blur="recuperarCliente()">
              </div>
            </div>
            <div class="row">
              <div class="input-field col-md-6">
                <i class="material-icons prefix">
                  <span ng-hide="procesandoCliente && !sinDocumento">account_circle</span>
                  <span ng-show="procesandoCliente && !sinDocumento">autorenew</span>
                </i>
                <input type="text" id="tbNombreRazonSocial" name="tbNombreRazonSocial" ng-model="cliente.nombre_razon_social" ng-disabled="sinDocumento" placeholder="Nombre o Razón Social">
                <label for="tbNombreRazonSocial">Nombre o Razón Social:</label>
              </div>
              <div class="input-field col-md-6">
                <i class="material-icons prefix">
                  <span ng-hide="procesandoCliente && !sinDocumento">home</span>
                  <span ng-show="procesandoCliente && !sinDocumento">autorenew</span>
                </i>
                <input type="text" id="tbDireccion" name="tbDireccion" ng-model="cliente.direccion" ng-disabled="sinDocumento" placeholder="Dirección">
                <label for="tbDireccion">Direccion:</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col-md-6">
                <input type="text" id="total_pagar" value="{@ getSum() @}" readonly="">
                <label for="total_pagar">Total a Pagar (S/):</label>
              </div>
              <div class="input-field col-md-6">
                <input type="text" id="tbEfectivo" name="tbEfectivo" ng-change="calcularVuelto()" ng-model="efectivo">
                <label for="tbEfectivo">Efectivo (S/):</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col-md-6">
              </div>
              <div class="input-field col-md-6">
                <input type="text" id="vuelto" value="{@ vuelto @}" readonly="" placeholder="Vuelto">
                <label for="vuelto">Vuelto (S/):</label>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <a class="btn btn-link" data-dismiss="modal">Cancelar</a>
          <button class="btn main-color btn-ob" ng-click="procesar()"
            ng-disabled="(comprobante.tipo === 'factura' ? !(cliente.numero_documento && cliente.nombre_razon_social && cliente.direccion) : (formNoValido)) || procesando">
            <span ng-hide="procesando">Finalizar</span>
            <span ng-show="procesando">
              <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Procesando...
            </span>
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- /Modal (Pop up when detail button clicked) -->
  <!-- Modal para reiniciar sesión -->
  @include('layouts.sesion')
  <!-- /Modal para reiniciar sesión -->
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/angular.min.js') }}" ></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" ></script>
<script src="{{ asset('js/mdb.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}" ></script>
@endsection
