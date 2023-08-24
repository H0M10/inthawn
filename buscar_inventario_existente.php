<?php
$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "AA";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idInventario = $_POST["idInventario"];

    $sql = "SELECT TInventario.*, TProductos.NombreProd, TProductos.Precio AS PrecioUnitarioProd, TProductos.IdCategoria 
            FROM TInventario 
            JOIN TProductos ON TInventario.IdProducto = TProductos.IdProducto 
            WHERE TInventario.IdInventario = ?";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idInventario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(array("error" => "No se encontró el inventario con el ID proporcionado."));
    }
}

$conn->close();
?>
