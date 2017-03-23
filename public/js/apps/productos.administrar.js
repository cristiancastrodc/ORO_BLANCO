// Definir la aplicación
var app = angular.module('administrarProductos', [], function($interpolateProvider) {
                          $interpolateProvider.startSymbol('{@');
                          $interpolateProvider.endSymbol('@}');
                       });
// Definir el controlador
app.controller('productosController', function ($scope, $http) {
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
    var ruta = '/admin/producto/eliminar/'+ $scope.id_producto
    $http.get(ruta)
    .success(function(response) {
      if (response.resultado == 'true') {
        swal({
          title : "¡Éxito!",
          text : "Producto eliminado correctamente.",
          type : "success",
        }, function () {
          var ruta = '/admin/productos/filtrar/' + $scope.estado
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
    var ruta = '/admin/productos/filtrar/' + estado
    $http.get(ruta)
    .success(function(response) {
      $scope.productos = response;
    })
  }
});
