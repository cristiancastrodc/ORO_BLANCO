@extends('layouts.dashboard')

@section('title')
  Reporte de Ventas
@endsection

@section('content')
  <div class="col-sm-8">
    <h2 class="font-main-color">Reporte de Ventas</h2>    
    <div class="form-group">
      <table class="table">
        <tr>
          <td>Fecha</td>
          <td>Cant. Tansacciones</td>
          <td>Sub Total (S/)</td>
          <td>IGV (S/)</td>
          <td>Total (S/)</td>
        </tr>
        @foreach($ventas as $venta)
        <tr>
          <td>{{ $venta->fecha }}</td>
          <td class="text-center">{{ $venta->cantidad }}</td>
          <td class="text-right">{{ $venta->sub_total }}</td>
          <td class="text-right">{{ $venta->igv }}</td>
          <td class="text-right">{{ $venta->total }}</td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection
