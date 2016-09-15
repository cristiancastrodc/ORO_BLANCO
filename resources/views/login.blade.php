<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Ventas | Oro Blanco Pastelería</title>
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css')}}">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-4 col-sm-offset-4">
        <div class="card hoverable">
          <form method="POST" action="{{ url('/login') }}">
            <div class="card-content">
              <img src="{{ asset('img/logo.png') }}" class="img-responsive center-block" alt="">
              <h5 class="text-center font-main-color">Sistema de Ventas</h5>
              <h6 class="text-center font-accent-color">Iniciar Sesión</h6>
              @if(Session::has('error'))
              <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                {{ Session::get('error') }}
              </div>
              @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group input-field">
                  <label for="tbUser">Usuario</label>
                  <input type="text" class="form-control" id="tbUser" name="tbUser" required="required" autofocus/>
                </div>
                <div class="form-group input-field">
                  <label for="tbPassword">Password</label>
                  <input type="password" class="form-control" id="tbPassword" name="tbPassword" required="required"/>
                </div>
            </div>
            <!--Buttons-->
            <div class="card-btn">
              <div class="row">
                <div class="col-md-6 col-md-offset-3">
                  <button type="submit" class="btn btn-block btn-ob main-color waves-effect waves-light">Entrar</button>
                </div>
              </div>
            </div>
            <!--/.Buttons-->
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/mdb.min.js') }}" ></script>
</body>
</html>
