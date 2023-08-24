<?php
// Conexión a la base de datos (reemplaza los valores con los de tu base de datos)
$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "pp";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta los IDs de categorías de la base de datos
$sql = "SELECT IdCategoria FROM TCategorias";
$result = $conn->query($sql);

$ids = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ids[] = $row["IdCategoria"];
    }
}

$conn->close();

// Devuelve los IDs en formato JSON
header('Content-Type: application/json');
echo json_encode($ids);
?>
