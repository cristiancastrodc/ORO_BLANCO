// Definir la aplicación
var app = angular.module('administrarUsuarios', [], function($interpolateProvider) {
                          $interpolateProvider.startSymbol('{@');
                          $interpolateProvider.endSymbol('@}');
                       });
// Definir el controlador
app.controller('usuariosController', function ($scope, $http) {
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
});
