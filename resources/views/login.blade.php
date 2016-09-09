<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Ventas | Oro Blanco Pastelería</title>
  <link href="{{ URL::asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <h1 class="title">Oro Blanco Pastelería</h1>
        <h2>Sistema de Ventas</h2>
        <h3>Iniciar Sesión</h3>
        @if(Session::has('error'))
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            {{ Session::get('error') }}
          </div>
        @endif
        <form method="POST" action="{{ url('/login') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label for="tbUser">Usuario:</label>
            <input type="text" class="form-control" id="tbUser" name="tbUser" required="required"/>
          </div>
          <div class="form-group">
            <label for="tbPassword">Password</label>
            <input type="password" class="form-control" id="tbPassword" name="tbPassword" required="required"/>
          </div>
          <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
      </div>
    </div>
  </div>
  <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js') }}"></script>
  <script src="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') }}" ></script>
  <script>
    $(document).ready(function() {
      $('#tbUser').focus();
    });
  </script>
</body>
</html>
