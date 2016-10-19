// Definir la aplicación
var app = angular.module('reporteVentas', [], function($interpolateProvider) {
                          $interpolateProvider.startSymbol('{@');
                          $interpolateProvider.endSymbol('@}');
                       });
// Definir el controlador
app.controller('reporteVentasController', function ($scope, $http) {
  // Función que muestra el modal de detalle
  $scope.mostrarDetalle = function(id_venta) {
    // Recuperación del detalle de la venta
    $http.get('detalle/' + id_venta)
    .success(function(response) {
      $scope.detalle = response;
      $('#modalDetalle').modal('show');
    });
  };
});
