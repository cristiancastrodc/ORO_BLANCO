// Definir la aplicación y la url para los procesos
var app = angular.module('puntoDeVenta', [], function($interpolateProvider) {
                   $interpolateProvider.startSymbol('{@');
                   $interpolateProvider.endSymbol('@}');
                 })
                 .constant('API_URL', '/ventas/');
// Definir el controlador
app.controller('POSController', function ($scope, $http, $timeout, API_URL) {
  // Recuperación inicial de todos los productos
  $http.get(API_URL + 'productos/filtrar')
  .success(function(response) {
    $scope.products = response;
  });
  // Iniciar la cuenta de productos
  $scope.itemsCnt = 1;
  // Iniciar la orden
  $scope.order = [];
  // Función para añadir productos a la orden
  $scope.add = function(item) {
    $scope.itemsCnt = $scope.order.length;
    var productItem = {
      id : $scope.itemsCnt,
      quantity : 1,
      item : item
    };
    $scope.order.push(productItem);
  };
  // Función para calcular el total
  $scope.getSum = function() {
    var i = 0;
    var quantity = 0;
    var price = 0;
    var sum = 0;
    for(; i < $scope.order.length; i++) {
      quantity = parseFloat($scope.order[i].quantity, 10);
      price = parseFloat($scope.order[i].item.precio_venta, 10);
      if (isNaN(quantity)) { quantity = 0; };
      sum += (quantity * price);
    }
    return sum.toFixed(2);
  };
  // Función para suprimir un producto de la orden
  $scope.deleteItem = function(index) {
    $scope.order.splice(index, 1);
  };
  // Función que muestra el modal resumen para finalizar la venta
  $scope.checkout = function(index) {
    $('#modalPago').modal('show');
  };
  $('#modalPago').on('shown.bs.modal', function () {
    $('#tbEfectivo').focus()
  });
  // Función que vacía la orden
  $scope.clearOrder = function() {
    $scope.order = [];
  };
  // Iniciar los datos del comprobante
  $scope.comprobante = {
    tipo: 'boleta'
  };
  // Iniciar datos del cliente
  $scope.cliente = {
    nombre_razon_social : '',
    numero_documento : '',
    direccion : ''
  }
  // Iniciar el vuelto
  $scope.vuelto = '';
  // Iniciar el monto del efectivo
  $scope.efectivo = '';
  // Iniciar atributo para validación del formulario
  $scope.formNoValido = true;
  // Función para calcular el vuelto
  $scope.calcularVuelto = function () {
    var total = $scope.getSum();
    var vuelto = parseFloat($scope.efectivo, 10) - parseFloat(total, 10);
    if (isNaN(vuelto)) {
      $scope.formNoValido = true;
      $scope.vuelto = '';
    } else {
      if (vuelto < 0) {
        $scope.formNoValido = true;
        $scope.vuelto = '';
      } else {
        $scope.formNoValido = false;
        $scope.vuelto = vuelto.toFixed(2);
      }
    };
  };
  // Iniciar el atributo que controla si se está procesando la venta
  $scope.procesando = false;
  // Función para procesar la venta
  $scope.procesar = function (argument) {
    $scope.procesando = true;
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
        efectivo: $scope.efectivo,
      }),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    })
    .success(function(response) {
      if (response.resultado) {
        location.href = response.ruta;
      } else {
        console.log('Error en Controlador');
      };
    })
  };
  // Iniciar el atributo para controlar el nombre y direccion
  $scope.sinDocumento = true;
  // Función para activar/desactivar el nombre y dirección
  $scope.validarDocumento = function (argument) {
    if ($scope.cliente.numero_documento != '') {
      $scope.sinDocumento = false;
    } else{
      $scope.sinDocumento = true;
      $scope.cliente.nombre_razon_social = '';
      $scope.cliente.direccion = '';
    };
  };
  // Función para intentar recuperar un Cliente
  $scope.procesandoCliente = false;
  $scope.recuperarCliente = function (argument) {
    $scope.procesandoCliente = true;
    $http.get(API_URL + 'punto_de_venta/cliente/' + $scope.cliente.numero_documento)
    .success(function(response) {
      if (response) {
        $scope.cliente = response;
      } else {
        console.log('No existe cliente.');
        $scope.cliente.nombre_razon_social = '';
        $scope.cliente.direccion = '';
      }
    })
    .finally(function () {
      $scope.procesandoCliente = false;
    });
  };
  // Recuperación inicial de todas las categorías
  $http.get(API_URL + 'categorias')
  .success(function(response) {
    $scope.categorias = response;
  });
  // Asignar la categoría
  $scope.categoria = '';
  $scope.asignarCategoria = function (id = '') {
    $scope.categoria = id;
  };
  // Función para realizar el filtrado según una categoría
  $scope.filtroCategoria = function(id_categoria, categoria) {
    if(categoria === '' || categoria === null) return true;
    return id_categoria === categoria;
  };
  // Función para realizar el filtrado según descripción
  $scope.filtroDescripcion = function (descripcion, texto) {
    if (texto === '' || texto === null) return true;
    var regex = new RegExp("\\b" + texto, "i");
    return regex.test(descripcion);
  };

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
    let url = '/usuario/ventas/login'
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
