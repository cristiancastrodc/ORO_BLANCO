// Definir la aplicación
let app = angular.module('administrarProductos', [], function($interpolateProvider) {
                          $interpolateProvider.startSymbol('{@');
                          $interpolateProvider.endSymbol('@}');
                       });
// Definir el controlador
app.controller('productosController', function ($scope, $http, $timeout) {
  // Atributos
  $scope.id_producto = ''
  $scope.productos = []
  $scope.estado = 0
  // Métodos que se ejecutan al inicializar el módulo
  $http.get('/admin/productos/filtrar/0')
  .success(function(response) {
    $scope.productos = response;
  })

  // Funciones
  $scope.confirmarEliminacion = function (id_producto) {
    $scope.id_producto = id_producto
    $('#modalConfirmacion').modal('show')
  }
  $scope.eliminarProducto = function () {
    $('#modalConfirmacion').modal('hide')
    let ruta = '/admin/producto/eliminar/'+ $scope.id_producto
    $http.get(ruta)
    .success(function(response) {
      if (response.resultado == 'true') {
        swal({
          title : "¡Éxito!",
          text : "Producto eliminado correctamente.",
          type : "success",
        }, function () {
          let ruta = '/admin/productos/filtrar/' + $scope.estado
          $http.get(ruta)
          .success(function(response) {
            $scope.productos = response;
          })
        })
      } else {
        swal({
          title : "Algo salió mal.",
          text : "No se puede eliminar el producto. Mensaje: " + response.mensaje,
          type : "error",
        })
      }
    });
  }
  $scope.filtrarProductos = function (estado) {
    let ruta = '/admin/productos/filtrar/' + estado
    $http.get(ruta)
    .success(function(response) {
      $scope.productos = response;
    })
  }

  // Métodos y atributos para revalidar la sesión
  $scope.esSesionValida = true
  $scope.timeOut = 1000// * 60 * 30
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
