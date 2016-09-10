<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') | Oro Blanco Pastelería</title>
  <link href="{{ URL::asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
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
            @if(Auth::user()->tipo == "admin")
              <li>
                <a href="{{ url('/admin/productos/create') }}" class="text-center">
                  <span class="glyphicon glyphicon-ice-lolly-tasted"></span><br>
                  Crear Productos
                </a>
              </li>
              <li>
                <a href="{{ url('/admin/usuarios/create') }}" class="text-center">
                  <span class="glyphicon glyphicon-user"></span><br>
                  Crear Usuarios
                </a>
              </li>
            @endif
            @if(Auth::user()->tipo == "ventas")
              <li>
                <a href="{{ url('/admin/usuarios/create') }}" class="text-center">
                  <span class="glyphicon glyphicon-user"></span><br>
                  Punto de Venta
                </a>
              </li>
            @endif
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="{{ url('/logout') }}" class="text-center">
                <span class="glyphicon glyphicon-off"></span><br>
                Cerrar Sesión
              </a>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
    </div>
    <div class="row">
      <div class="col-sm-8">
        @yield('content')
      </div>
    </div>
  </div>
  <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js') }}"></script>
  <script src="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') }}" ></script>
</body>
</html>