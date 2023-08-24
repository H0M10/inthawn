<?php
$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "AA"; // Actualizado a la base de datos correcta

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idInventario = $_POST["idInventario"];
    $cantidad = $_POST["cantidadInv"];
    
    $cantidadSumar = isset($_POST["cantidadSumar"]) ? $_POST["cantidadSumar"] : 0;
    $cantidadRestar = isset($_POST["cantidadRestar"]) ? $_POST["cantidadRestar"] : 0;

    $cantidad = intval($cantidad) + intval($cantidadSumar) - intval($cantidadRestar);

    if ($cantidad < 0) {
        echo "Error: La cantidad de inventario no puede ser negativa.";
        exit;
    }

    $sql = "UPDATE TInventario SET Cantidad = '$cantidad' WHERE IdInventario = '$idInventario'";

    if ($conn->query($sql) === TRUE) {
        echo "Inventario actualizado correctamente";
    } else {
        echo "Error al actualizar el inventario: " . $conn->error;
    }
}

$conn->close();
?>
