<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "No has iniciado sesión. Redirigiendo...";
    header("Location: login.php");
    exit;
} elseif (isset($_SESSION['user']['IdTipo']) && ($_SESSION['user']['IdTipo'] == "3")) {
    // Si el usuario es de tipo 3, redirigir a otra página o mostrar un mensaje de error.
    echo "No tienes permiso para acceder a esta página.";
    header("Location: pagina_error.php"); // Puedes redirigir a cualquier página que desees.
    exit;
} else {
    echo "Has iniciado sesión."; 
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
include 'db.php';

// Obtener datos para la gráfica de usuarios registrados
$stmt1 = $pdo->query("SELECT COUNT(IdUsuario) as total_usuarios FROM TUsuario");
$row1 = $stmt1->fetch();
$total_usuarios = $row1['total_usuarios'];

// Obtener datos para la gráfica de ventas
$stmt2 = $pdo->query("SELECT COUNT(IdVenta) as total_ventas FROM TVentas");
$row2 = $stmt2->fetch();
$total_ventas = $row2['total_ventas'];

// Obtener datos para la gráfica de cantidad vendida
$stmt3 = $pdo->query("SELECT SUM(Cantidad) as total_cantidad FROM TDetallesVenta");
$row3 = $stmt3->fetch();
$total_cantidad = $row3['total_cantidad'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: black;
            color: white;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <a href="admin.php" class="btn btn-warning mb-4">Regresar</a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-8 text-center">
            <canvas id="chartUsuarios" width="400" height="200"></canvas>
            <a href="reportesusu.php" class="btn btn-primary mt-2">Ver Reporte de Usuarios</a>
        </div>
    </div>
    
    <div class="row mb-4">
        <div class="col-md-8 text-center">
            <canvas id="chartVentas" width="400" height="200"></canvas>
            <a href="ventas.php" class="btn btn-secondary mt-2">Ver Reporte de Venta</a>
        </div>
    </div>
    
    <div class="row mb-4">
        <div class="col-md-8 text-center">
            <canvas id="chartCantidad" width="400" height="200"></canvas>
            <a href="reporte_productos.php" class="btn btn-success mt-2">Ver Reporte de Cantidad</a>
        </div>
    </div>
</div>

<script>
// Gráfica de Usuarios
var ctx1 = document.getElementById('chartUsuarios').getContext('2d');
var chartUsuarios = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: ['Usuarios registrados'],
        datasets: [{
            label: 'Datos',
            data: [<?php echo $total_usuarios; ?>],
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Gráfica de Ventas
var ctx2 = document.getElementById('chartVentas').getContext('2d');
var chartVentas = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ['Ventas'],
        datasets: [{
            label: 'Datos',
            data: [<?php echo $total_ventas; ?>],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Gráfica de Cantidad Vendida
var ctx3 = document.getElementById('chartCantidad').getContext('2d');
var chartCantidad = new Chart(ctx3, {
    type: 'bar',
    data: {
        labels: ['Cantidad vendida'],
        datasets: [{
            label: 'Datos',
            data: [<?php echo $total_cantidad; ?>],
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            borderColor: 'rgba(255, 206, 86, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</body>
</html>
