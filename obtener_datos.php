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




$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "AA"; // Actualizo el nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Ventas por mes
$sql1 = "SELECT DATE_FORMAT(v.FechaVenta, '%Y-%m') AS Mes, SUM(dv.Cantidad) as Total 
         FROM TVentas v 
         JOIN TDetallesVenta dv ON dv.IdVenta = v.IdVenta 
         GROUP BY Mes";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
$result1 = $stmt1->get_result();
$data1 = $result1->fetch_all(MYSQLI_ASSOC);
$stmt1->close();


// Usuarios registrados por mes
$sql3 = "SELECT DATE_FORMAT(FechaRegistroUsu, '%Y-%m') AS Mes, COUNT(*) as Total FROM TUsuario GROUP BY Mes";
$stmt3 = $conn->prepare($sql3);
$stmt3->execute();
$result3 = $stmt3->get_result();
$data3 = $result3->fetch_all(MYSQLI_ASSOC);
$stmt3->close();

// Las otras consultas, como ventas por categoría de producto, sucursales con más empleados, y clientes con más compras, necesitarían más información sobre la estructura de tu base de datos para ser adaptadas adecuadamente.

$conn->close();

// Crear un arreglo asociativo con los datos y convertirlo a formato JSON
$data = array(
  'ventasPorMes' => $data1,
  'usuariosPorMes' => $data3
  // ... (otros datos)
);

echo json_encode($data);
?>
