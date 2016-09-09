<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Oro Blanco Pastelería</title>
  <link href="{{ URL::asset('css/reset.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900') }}" rel="stylesheet">
  <link href="{{ URL::asset('http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="card"></div>
    <div class="card">
      <h1 class="title">Oro Blanco</h1>
      <form method="POST" action="{{ url('/login') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="input-container">
          <input type="text" id="tbUser" name="tbUser" required="required"/>
          <label for="tbUser">Usuario</label>
          <div class="bar"></div>
        </div>
        <div class="input-container">
          <input type="password" id="tbPassword" name="tbPassword" required="required"/>
          <label for="tbPassword">Contraseña</label>
          <div class="bar"></div>
        </div>
        <div class="button-container">
          <button><span>Entrar</span></button>
        </div>
      </form>
    </div>
  </div>
  <script src="{{ asset('http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js') }}"></script>
  <script src="{{ asset('js/index.js') }}"></script>
</body>
</html>
