<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') | Oro Blanco Pastelería</title>
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css')}}">
</head>
<body>
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
            @if(Auth::user()->tipo == "admin")
              <li>
                <a href="{{ url('/admin/productos/create') }}" class="text-center">
                  <i class="material-icons md-36">free_breakfast</i><br>
                  Crear Producto
                </a>
              </li>
              <li>
                <a href="{{ url('/admin/productos/') }}" class="text-center">
                  <i class="material-icons md-36">assignment</i><br>
                  Administrar Productos
                </a>
              </li>
              <li>
                <a href="{{ url('/admin/usuarios/create') }}" class="text-center">
                  <i class="material-icons md-36">person_add</i><br>
                  Crear Usuarios
                </a>
              </li>
              <li>
                <a href="{{ url('/admin/business_config/create') }}" class="text-center">
                  <i class="material-icons md-36">business</i><br>
                  Configuracion Empresa
                </a>
              </li>
              <li>
                <a href="{{ url('/admin/anulacion') }}" class="text-center">
                  <i class="material-icons md-36">remove_shopping_cart</i><br>
                  Anular Venta
                </a>
              </li>
            @endif
            @if(Auth::user()->tipo == "ventas")
              <li>
                <a href="{{ url('/ventas/verificar_sesion') }}" class="text-center">
                  <i class="material-icons md-36">store</i><br>
                  Punto de Venta
                </a>
              </li>
              <li>
                <a href="{{ url('/ventas/caja/cierre') }}" class="text-center">
                  <i class="material-icons md-36">attach_money</i><br>
                  Cierre de Caja
                </a>
              </li>
              <li>
                <a href="{{ url('/ventas/resumen_ventas') }}" class="text-center">
                  <i class="material-icons md-36">description</i><br>
                  Resumen de Ventas
                </a>
              </li>
            @endif
          </ul>          
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="{{ url('/logout') }}" class="text-center">
                <i class="material-icons md-36">power_settings_new</i><br>
                Cerrar Sesión
              </a>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="{{ url('/perfil') }}" class="text-center">
                <i class="material-icons md-36">person</i><br>
                Perfil
              </a>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
    </div>
    <div class="row">
      <div class="col-sm-12">
        @if(Session::has('message'))
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ Session::get('message') }}
          </div>
        @endif
      </div>
    </div>
    <div class="row">
      @yield('content')
    </div>
  </div>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/mdb.min.js') }}" ></script>
  @yield('scripts')
</body>
</html>