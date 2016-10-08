<!DOCTYPE html>
<html lang="es" ng-app="puntoDeVenta">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Punto de Venta | Oro Blanco Pastelería</title>
  <link href="<?php echo asset('css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?php echo asset('css/mdb.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo asset('css/style.css'); ?>" rel="stylesheet">
</head>
<body data-ng-controller="POSController">
  <div class="container">
    <div class="row">
      <nav class="navbar accent-color">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header visible-xs">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Oro Blanco</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li>
              <a href="<?php echo url('/ventas/verificar_sesion'); ?>" class="text-center">
                <i class="material-icons md-36">store</i><br>
                Punto de Venta
              </a>
            </li>
            <li>
              <a href="<?php echo url('/ventas/caja/cierre'); ?>" class="text-center">
                <i class="material-icons md-36">attach_money</i><br>
                Cierre de Caja
              </a>
            </li>
            <li>
              <a href="<?php echo url('/ventas/resumen_ventas'); ?>" class="text-center">
                <i class="material-icons md-36">description</i><br>
                Resumen de Ventas
              </a>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="<?php echo url('/perfil'); ?>" class="text-center">
                <i class="material-icons md-36">person</i><br>
                Perfil
              </a>
            </li>
            <li>
              <a href="<?php echo url('/logout'); ?>" class="text-center">
                <i class="material-icons md-36">power_settings_new</i><br>
                Cerrar Sesión
              </a>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
    </div>
    <div class="row">
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
                <td>{{ item.item.descripcion }}</td>
                <td>
                  <input type="text" value="{{ item.quantity }}" ng-model="item.quantity" class="text-right table-input">
                </td>
                <td class="text-right"><div class="label label-success ob-labels">S/ {{ item.item.precio_venta }}</div></td>
              </tr>
            </table>
          </div>
          <div class="panel-footer text-right" ng-show="order.length">
            <span class="label label-danger ob-labels">Total: S/ {{ getSum() }}</span>
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
                <div class="form-group input-field">
                  <i class="material-icons prefix">search</i>
                  <input type="text" class="form-control" id="tbFiltro" placeholder="Buscar" ng-model="filtro" ng-change="filtrarProductos()" ng-model-options="{debounce:1000}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4" ng-repeat="product in products">
                <div class="card-panel accent-color text-center text-uppercase products" ng-click="add(product)">
                  <span class="white-text">{{ product.descripcion }}</span>
                </div>
              </div>
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
                    <div class="radio">
                      <label>
                        <input type="radio" ng-model="comprobante.tipo" name="radComprobante" id="radComprobante" value="boleta">
                        Boleta
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" ng-model="comprobante.tipo" name="radComprobante" id="radComprobante" value="factura">
                        Factura
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="tbNumeroDocumento" class="col-sm-3 control-label">DNI o RUC:</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="tbNumeroDocumento" name="tbNumeroDocumento" ng-model="cliente.numero_documento" ng-change="validarDocumento()" ng-blur="recuperarCliente()">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tbNombreRazonSocial" class="col-sm-3 control-label">Nombre o Razón Social:</label>
                  <div class="col-sm-9 input-field">
                    <i class="material-icons prefix">
                      <span ng-hide="procesandoCliente && !sinDocumento">account_circle</span>
                      <span ng-show="procesandoCliente && !sinDocumento">autorenew</span>
                    </i>
                    <input type="text" class="form-control" id="tbNombreRazonSocial" name="tbNombreRazonSocial" ng-model="cliente.nombre_razon_social" ng-disabled="sinDocumento">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tbDireccion" class="col-sm-3 control-label">Direccion:</label>
                  <div class="col-sm-9 input-field">
                    <i class="material-icons prefix">
                      <span ng-hide="procesandoCliente && !sinDocumento">home</span>
                      <span ng-show="procesandoCliente && !sinDocumento">autorenew</span>
                    </i>
                    <input type="text" class="form-control" id="tbDireccion" name="tbDireccion" ng-model="cliente.direccion" ng-disabled="sinDocumento">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Total a Pagar:</label>
                  <div class="col-sm-9">
                    <p class="form-control-static">S/ {{ getSum() }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="tbEfectivo" class="col-sm-3 control-label">Efectivo:</label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <div class="input-group-addon">S/</div>
                      <input type="text" class="form-control" id="tbEfectivo" name="tbEfectivo" ng-change="calcularVuelto()" ng-model="efectivo">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Vuelto:</label>
                  <div class="col-sm-9">
                    <p class="form-control-static">S/ {{ vuelto }}</p>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <a class="btn btn-link" data-dismiss="modal">Cancelar</a>
              <button class="btn main-color btn-ob" ng-click="procesar()" ng-disabled="formNoValido || procesando">
                <span ng-hide="procesando">Finalizar</span>
                <span ng-show="procesando">
                  <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Procesando...
                </span>
              </button>
            </div>
          </div>
      </div>
  </div>
  <script src="<?php echo asset('js/angular.min.js'); ?>" ></script>
  <script src="<?php echo asset('js/jquery.min.js'); ?>"></script>
  <script src="<?php echo asset('js/bootstrap.min.js'); ?>" ></script>
  <script src="<?php echo asset('js/mdb.min.js'); ?>"></script>
  <script src="<?php echo asset('js/app.js'); ?>" ></script>
</body>
</html>