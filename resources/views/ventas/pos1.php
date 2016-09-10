<!DOCTYPE html>
<html lang="es" ng-app="puntoDeVenta">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Punto de Venta | Oro Blanco Pastelería</title>
  <link href="<?php echo asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') ?>" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link href="<?php echo asset('https://fonts.googleapis.com/icon?family=Material+Icons'); ?>" rel="stylesheet">
  <style>
    .material-icons.md-36 { font-size: 36px; }
    .buttons{padding: 20px;}
    .btn {
      white-space: normal;
      text-transform: uppercase;
    }
    .ob-labels { font-size: 16px; }
  </style>
</head>
<body data-ng-controller="POSController">
  <div class="container">
    <div class="row">
      <nav class="navbar navbar-default">
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
              <a href="<?php url('/ventas/verificar_sesion'); ?>" class="text-center">
                <i class="material-icons md-36">attach_money</i><br>
                Cierre de Caja
              </a>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
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
        <div class="panel panel-danger">
          <div class="panel-heading">
            <h3 class="panel-title">Venta</h3>
          </div>
          <div class="panel-body">
            <div class="text-warning" ng-hide="order.length">
              Seleccione productos...
            </div>
            <ul class="list-group">
              <li class="list-group-item" ng-repeat = "item in order">
                <button class="btn btn-danger btn-xs" ng-click="deleteItem($index)">
                  <span class="glyphicon glyphicon-trash"></span>
                </button>
                {{ item.item.descripcion }}
                <div class="label label-success ob-labels pull-right">S/ {{ item.item.precio_venta }}</div>
              </li>
            </ul>
          </div>
          <div class="panel-footer text-right" ng-show="order.length">
            <span class="label label-danger ob-labels">Total: S/ {{ getSum() }}</span>
          </div>
          <div class="panel-footer text-right">
            <span class="btn btn-default" ng-click="clearOrder()" ng-disabled="!order.length">Limpiar</span>
            <span class="btn btn-danger" ng-click="checkout()" ng-disabled="!order.length">Pago</span>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Productos</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-6" ng-repeat="product in products">
                <button class="buttons btn btn-block btn-primary" ng-click="add(product)">{{ product.descripcion }}</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal (Pop up when detail button clicked) -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <input type="radio" ng-model="comprobante.tipo" name="radComprobante" id="radComprobante" value="boleta" checked>
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
                  <label for="tbNombreRazonSocial" class="col-sm-3 control-label">Nombre o Razón Social:</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="tbNombreRazonSocial" name="tbNombreRazonSocial" ng-model="cliente.nombre_razon_social">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tbNumeroDocumento" class="col-sm-3 control-label">DNI o RUC:</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="tbNumeroDocumento" name="tbNumeroDocumento" ng-model="cliente.numero_documento">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tbDireccion" class="col-sm-3 control-label">Direccion:</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="tbDireccion" name="tbDireccion"  ng-model="cliente.direccion">
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
              <a class="btn btn-danger" ng-click="guardar()">Finalizar</a>
            </div>
          </div>
      </div>
  </div>
  <script src="<?php echo asset('https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js'); ?>" ></script>
  <script src="<?php echo asset('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'); ?>"></script>
  <script src="<?php echo asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'); ?>" ></script>
  <script src="<?php echo asset('js/app.js'); ?>" ></script>
</body>
</html>