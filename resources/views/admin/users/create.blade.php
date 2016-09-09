<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Crear Usuario | Oro Blanco Pastelería</title>
  <link href="{{ URL::asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <h1>Crear Usuario</h1>
        <form class="form-horizontal" method="POST" action="{{ url('/admin/usuarios/store') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label for="tbUser" class="col-sm-2 control-label">Usuario:</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="tbUser" name="tbUser" placeholder="Usuario">
              <span class="help-block">Ingrese el usuario para el inicio de sesión.</span>
            </div>
          </div>
          <div class="form-group">
            <label for="tbPassword" class="col-sm-2 control-label">Contraseña:</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="tbPassword" name="tbPassword" placeholder="Contraseña">
            </div>
          </div>
          <div class="form-group">
            <label for="tbDNI" class="col-sm-2 control-label">DNI:</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="tbDNI" name="tbDNI" placeholder="DNI">
            </div>
          </div>
          <div class="form-group">
            <label for="tbFirstName" class="col-sm-2 control-label">Nombres:</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="tbFirstName" name="tbFirstName" placeholder="Nombres">
            </div>
          </div>
          <div class="form-group">
            <label for="tbLastName" class="col-sm-2 control-label">Apellidos:</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="tbLastName" name="tbLastName" placeholder="Apellidos">
            </div>
          </div>
          <div class="form-group">
            <label for="selRole" class="col-sm-2 control-label">Rol:</label>
            <div class="col-sm-10">
              <select class="form-control" id="selRole" name="selRole">
                <option>Administrador</option>
                <option>Ventas</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js') }}"></script>
  <script src="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') }}" ></script>
</body>
</html>