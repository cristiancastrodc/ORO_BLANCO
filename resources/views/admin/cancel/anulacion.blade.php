@extends('layouts.dashboard')

@section('title')
  Anular Venta
@endsection

@section('content')
  <div class="col-sm-8">
    <h2 class="font-main-color">Anular Venta</h2>
    <form class="form-horizontal" method="POST" action="{{ url('/admin/mostrar_venta') }}">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="tipo_comprobante" class="col-sm-2 control-label">Tipo de Comprobante:</label>
        <div class="col-sm-10">
          <select class="form-control" id="tipo_comprobante" name="tipo_comprobante">
            <option value="boleta" selected="">Boleta</option>
            <option value="factura">Factura</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="tbTicket" class="col-sm-2 control-label">Numero de Ticket:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tbTicket" name="tbTicket" placeholder="Ingrese el numero del ticket ">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn main-color btn-ob waves-effect waves-light">Buscar Venta</button>
        </div>
      </div>
    </form>
  </div>
@endsection


