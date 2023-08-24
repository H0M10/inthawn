<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "pp";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$idProducto = $_POST['idProducto'];

// Consulta la descripción del producto dado su IdProducto
$sql = "SELECT DescripcionProd FROM TProductos WHERE IdProducto = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $idProducto);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Devuelve la descripción del producto
    $row = $result->fetch_assoc();
    echo $row['DescripcionProd'];
}

$conn->close();
?>
