// Definir la aplicación
var app = angular.module('administrarUsuarios', [], function($interpolateProvider) {
                          $interpolateProvider.startSymbol('{@');
                          $interpolateProvider.endSymbol('@}');
                       });
// Definir el controlador
app.controller('usuariosController', function ($scope, $http, $timeout) {
  // Atributos
  $scope.id_usuario = ''
  // Funciones
  $scope.confirmarEliminacion = function (id_usuario) {
    $scope.id_usuario = id_usuario
    $('#modalConfirmacion').modal('show')
  }
  $scope.eliminarUsuario = function () {
    $('#modalConfirmacion').modal('hide')
    var ruta = '/admin/usuario/eliminar/'+ $scope.id_usuario
    $http.get(ruta)
    .success(function(response) {
      if (response.resultado == 'true') {
        swal({
          title : "¡Éxito!",
          text : "Usuario eliminado correctamente.",
          type : "success",
        }, function () {
          window.location.reload()
        })
      } else {
        swal({
          title : "Algo salió mal.",
          text : "No se puede eliminar al usuario. Mensaje: " + response.mensaje,
          type : "error",
        })
      }
    });
  }

  // Métodos y atributos para revalidar la sesión
  $scope.esSesionValida = true
  $scope.timeOut = 1000 * 60 * 10
  $scope.user = null
  $scope.password = null
  $scope.mensajeSesion = null

  let countUp = function() {
    // Verificar si la sesión caducó
    let ruta = '/sesion/validar'
    if ($scope.esSesionValida) {
      $http.get(ruta)
      .success(function (response) {
        $scope.esSesionValida = response.resultado
      })
      $timeout(countUp, $scope.timeOut);
    } else {
      $('#modalSesion').modal('show')
    }
  }
  $timeout(countUp, $scope.timeOut);

  $scope.validarSesion = function () {
    let url = '/usuario/admin/login'
    $http.post(url, {
      user : $scope.user,
      password : $scope.password,
    })
    .success(function (response) {
      if (response.redireccionar) {
        window.location = '/dashboard'
      } else {
        $scope.esSesionValida = response.resultado
        $scope.mensajeSesion = response.mensaje
        if ($scope.esSesionValida) {
          $('#modalSesion').modal('hide')
          $timeout(countUp, $scope.timeOut);
        }
      }
    })
  }
});
