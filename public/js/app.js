var app = angular.module('puntoDeVenta', [])
                 .constant('API_URL', 'http://localhost/ventas/');

app.controller('POSController', function ($scope, $http, API_URL) {
  //retrieve employees listing from API
  $http.get(API_URL + 'productos')
       .success(function(response) {
          $scope.products = response;
        });

    $scope.itemsCnt = 1;

    $scope.order = [];

    $scope.add = function(item) {
      $scope.itemsCnt = $scope.order.length;
      var productItem = {
        id : $scope.itemsCnt,
        item : item
      };
      $scope.order.push(productItem);
    };

    $scope.getSum = function() {
      var i = 0,
        sum = 0;
      for(; i < $scope.order.length; i++) {
        sum += parseFloat($scope.order[i].item.precio_venta, 10);
      }
      return sum.toFixed(2);
    };

    $scope.deleteItem = function(index) {
      $scope.order.splice(index, 1);
    };

    $scope.checkout = function(index) {
      var total = $scope.getSum();
      if (total > 0) {
        $('#myModal').modal('show');
      };
    };

    $scope.clearOrder = function() {
      $scope.order = [];
    };

    $scope.vuelto = '0.00';
    $scope.efectivo = 0;
    $scope.calcularVuelto = function () {
      var total = $scope.getSum();
      var vuelto = parseFloat($scope.efectivo, 10) - parseFloat(total, 10);
      if (isNaN(vuelto)) {
        $scope.vuelto = '0.00';
      } else {
        if (vuelto < 0) {
          $scope.vuelto = '0.00';
        } else {
          $scope.vuelto = vuelto.toFixed(2);
        }
      };
    };

    $scope.guardar = function (argument) {
      var url = API_URL + "punto_de_venta/guardar";
      var totalVenta = $scope.getSum();
      $http({
          method: 'POST',
          url: url,
          data : $.param({
            cliente : $scope.cliente,
            venta   : $scope.comprobante,
            detalle : $scope.order,
            total   : totalVenta,
          }),
          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      }).success(function(response) {
          console.log(response);
          //location.reload();
      }).error(function(response) {
          console.log(response);
          //alert('This is embarassing. An error has occured. Please check the log for details');
      });
    };
});