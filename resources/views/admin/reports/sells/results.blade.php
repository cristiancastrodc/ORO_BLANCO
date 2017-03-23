@extends('layouts.dashboard')

@section('title')
  Reporte de Ventas
@endsection

@section('content')
  <div ng-app="reporteVentas" >
    <div data-ng-controller="reporteVentasController">
      <div class="col-sm-12">
        <h2 class="font-main-color">Reporte de Ventas</h2>
        <div class="form-group">
          <label class="col-sm-2 control-label">Número de Ventas:</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $nro_ventas }}</p>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Monto Total:</label>
          <div class="col-sm-10">
            <p class="form-control-static">S/ {{ $monto_total }}</p>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Monto Total Anulados:</label>
          <div class="col-sm-10">
            <p class="form-control-static">S/ {{ $monto_anulado }}</p>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">{{ $nom_fecha }}:</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $fechas }}</p>
          </div>
        </div>
        <div class="form-group">
          <table class="table">
            <tr>
              <td>Fecha</td>
              <td>Vendido Por</td>
              <td>Comprobante</td>
              <td>Cliente</td>
              <td>Cantidad</td>
              <td>Sub Total (S/)</td>
              <td>IGV (S/)</td>
              <td>Total (S/)</td>
              <td>¿Anulada?</td>
              <td>Detalle</td>
            </tr>
            @foreach($ventas as $venta)
            <tr>
              <td>{{ $venta->fecha_hora_emision }}</td>
              <td>{{ $venta->usuario }}</td>
              <td>{{ $venta->comprobante }}</td>
              <td>{{ $venta->nombre_razon_social }}</td>
              <td class="text-right">{{ $venta->cantidad }}</td>
              <td class="text-right">{{ $venta->sub_total }}</td>
              <td class="text-right">{{ $venta->igv }}</td>
              <td class="text-right">{{ $venta->total }}</td>
              <td>@if(boolval($venta->esta_anulada)) Si @endif</td>
              <td><a ng-click="mostrarDetalle({{ $venta->id }})"><i class="material-icons">receipt</i></a></td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>

      <div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              <h4 class="modal-title" id="myModalLabel">Detalle de la Venta</h4>
            </div>
            <div class="modal-body">
              <table class="table">
                <tr>
                  <td>Descripción</td>
                  <td>Cantidad</td>
                  <td>Precio Unitario (S/)</td>
                  <td>Precio Total (S/)</td>
                </tr>
                <tr ng-repeat="fila in detalle">
                  <td class="text-uppercase">{@ fila.descripcion_corta @}</td>
                  <td class="text-right">{@ fila.cantidad @}</td>
                  <td class="text-right">{@ fila.precio_unitario @}</td>
                  <td class="text-right">{@ fila.precio_total @}</td>
                </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
  <script src="{{ asset('js/angular.min.js') }}"></script>
  <script src="{{ asset('js/reportes/ventas.js') }}"></script>
@endsection
