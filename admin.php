<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "No has iniciado sesión. Redirigiendo...";
    header("Location: login.php");
    exit;
} else {
    echo "Has iniciado sesión."; // Agrega esta línea para depuración
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  

  
<body>
  <div class="sidebar">
    <ul class="sidebar-nav">
      <li><a href="#" onclick="loadContent('tcategorias.php')"><i class="fas fa-tags"></i> Agregar Categorías</a></li>
      <li><a href="#" onclick="loadContent('tcategorias_informacion.php')"><i class="fas fa-tags"></i> Gestionar Categorías</a></li>

      <li><a href="#" onclick="loadContent('tproductos.php')"><i class="fas fa-box"></i> Agregar Productos</a></li>
      <li><a href="#" onclick="loadContent('Tproductos_informacion.php')"><i class="fas fa-box"></i> Gestionar Productos</a></li>

      
      
      
    
      <?php 
$showUserLinks = isset($_SESSION['user']) && ($_SESSION['user']['IdTipo'] != "2" && $_SESSION['user']['IdTipo'] != "3");
if ($showUserLinks) { 
?>
    <li><a href="#" onclick="loadContent('tusuarios.php')"><i class="fas fa-users"></i> Agregar Usuarios</a></li>
<?php 
} 
?>      

      <li><a href="#" onclick="loadContent('tinventario.php')"><i class="fas fa-clipboard-list"></i> Gestionar Inventario</a></li>

      <li><a href="#" onclick="loadContent('tsucursales.php')"><i class="fas fa-building"></i> Agregar Sucursales</a></li>
      <li><a href="#" onclick="loadContent('tsucursales_informacion.php')"><i class="fas fa-building"></i> Gestionar Sucursales</a></li>
      <a href="logout.php">
       <button id="cerrar-sesion">Cerrar sesión</button>
      </a>




      <li><a href="graficar.php">Cargar Gráficas</a></li>

      
      <!-- Agrega más elementos de navegación según tus necesidades -->
    </ul>
  </div>

  <div class="content" id="dynamic-content">
    <!-- Aquí se cargará el contenido dinámicamente -->
  </div>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <script>





    // Carga la barra de navegación al cargar la página
    $(document).ready(function() {
      $("#barra-lateral").load("barranav.html");
    });

    function cargarCategorias() {
      $.ajax({
        url: "opciones_categorias.php",
        success: function(data) {
          $("#idCategoria").html(data);
        }
      });
    }

    function cargarEmpleados() {
      $.ajax({
        url: "opciones_empleados.php",
        success: function(data) {
          $("#idEmpleado").html(data);
        }
      });
    }

    function cargarEstatus() {
      $.ajax({
        url: "opciones_estatus.php",
        success: function(data) {
          $("#idEstatus").html(data);
        }
      });
    }

    function cargarSucursales() {
      $.ajax({
        url: "opciones_sucursales.php",
        success: function(data) {
          $("#idSucursal").html(data);
        }
      });
    }

    function cargarProductos() {
      $.ajax({
        url: "opciones_productos.php",
        success: function(data) {
          $("#idProducto").html(data);
        }
      });
    }

    function cargarSucursalesAgregar() {
      $.ajax({
        url: "opciones_sucursales.php",
        success: function(data) {
          $("#idSucursalAgregar").html(data);
        }
      });
    }

    function loadContent(url) {
      const dynamicContent = document.getElementById('dynamic-content');
      
      // Primero, remueve la clase 'loaded' para iniciar la transición de opacidad
      dynamicContent.classList.remove('loaded');
      
      dynamicContent.innerHTML = 'Cargando...';

      fetch(url)
        .then(response => response.text())
        .then(data => {
          dynamicContent.innerHTML = data;
          cargarCategorias();
          cargarEmpleados();
          cargarEstatus();
          cargarSucursales();
          cargarProductos();
          cargarSucursalesAgregar();

          // Una vez cargado el contenido, añade la clase 'loaded' para completar la transición de opacidad
          dynamicContent.classList.add('loaded');

          // Verifica si el enlace seleccionado es "Cargar Gráficas"
          if (url === 'graficar.php') {
            loadCharts(); // Carga las gráficas
          }
        })
        .catch(error => {
          dynamicContent.innerHTML = 'Error al cargar el contenido.';
          console.error(error);
          
          // Si hay un error, igualmente añade la clase 'loaded' para completar la transición de opacidad
          dynamicContent.classList.add('loaded');
        });
    }

    function loadCharts() {
      // Lógica para cargar y mostrar las gráficas
      fetch('obtener_datos.php')
        .then(response => response.json())
        .then(data => {
          // Grafica Ventas por Mes
          var ctxVentasPorMes = document.getElementById('ventasPorMes').getContext('2d');
          new Chart(ctxVentasPorMes, {
            type: 'line',
            data: {
              labels: data.ventasPorMes.map(item => item.Mes),
              datasets: [{
                label: 'Ventas por Mes',
                data: data.ventasPorMes.map(item => item.Total),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
              }]
            },
            options: {}
          });

          // Grafica Ventas por Sucursal
          var ctxVentasPorSucursal = document.getElementById('ventasPorSucursal').getContext('2d');
          new Chart(ctxVentasPorSucursal, {
            type: 'bar',
            data: {
              labels: data.ventasPorSucursal.map(item => item.IdSucursal),
              datasets: [{
                label: 'Ventas por Sucursal',
                data: data.ventasPorSucursal.map(item => item.Total),
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
              }]
            },
            options: {}
          });

          // Grafica Usuarios por Mes
          var ctxUsuariosPorMes = document.getElementById('usuariosPorMes').getContext('2d');
          new Chart(ctxUsuariosPorMes, {
            type: 'line',
            data: {
              labels: data.usuariosPorMes.map(item => item.Mes),
              datasets: [{
                label: 'Usuarios por Mes',
                data: data.usuariosPorMes.map(item => item.Total),
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
              }]
            },
            options: {}
          });

          // Grafica Ventas por Categoría
          var ctxVentasPorCategoria = document.getElementById('ventasPorCategoria').getContext('2d');
          new Chart(ctxVentasPorCategoria, {
            type: 'bar',
            data: {
              labels: data.ventasPorCategoria.map(item => item.Nombre),
              datasets: [{
                label: 'Ventas por Categoría',
                data: data.ventasPorCategoria.map(item => item.Total),
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
              }]
            },
            options: {}
          });

          // Grafica Sucursales con más Empleados
          var ctxSucursalesConMasEmpleados = document.getElementById('sucursalesConMasEmpleados').getContext('2d');
          new Chart(ctxSucursalesConMasEmpleados, {
            type: 'bar',
            data: {
              labels: data.sucursalesConMasEmpleados.map(item => item.IdSucursal),
              datasets: [{
                label: 'Sucursales con más Empleados',
                data: data.sucursalesConMasEmpleados.map(item => item.Total),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
              }]
            },
            options: {}
          });

          // Grafica Clientes con más Compras
          var ctxClientesConMasCompras = document.getElementById('clientesConMasCompras').getContext('2d');
          new Chart(ctxClientesConMasCompras, {
            type: 'bar',
            data: {
              labels: data.clientesConMasCompras.map(item => item.IdCliente),
              datasets: [{
                label: 'Clientes con más Compras',
                data: data.clientesConMasCompras.map(item => item.Total),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
              }]
            },
            options: {}
          });
        })
        .catch(error => {
          console.error(error);
        });
    }
    

    // Cargar la página inicial al cargar el admin.html
    loadContent('tproductos.php');
  </script>

  
</body>

</html>
