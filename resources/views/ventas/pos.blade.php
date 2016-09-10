@extends('layouts.dashboard')

@section('title')
  Punto de Venta
@endsection

@section('content')
  <div class="col-sm-12">
    <div class="row">
        <div class="col-sm-6">
          <div class="panel panel-danger">
            <div class="panel-heading">
              <h3 class="panel-title">Venta</h3>
            </div>
            <div class="panel-body">
              Panel content
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
                @foreach($products as $product)
                  <div class="col-sm-6">
                    <button class="buttons btn btn-block btn-primary">
                      {{ $product->descripcion }}
                    </button>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
@endsection
