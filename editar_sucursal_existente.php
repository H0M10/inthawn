<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "pp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idSucursal = $_POST["idSucursal"];
    $encargadoSucursal = $_POST["encargadoSucursal"];
    $telefonoSucursal = $_POST["telefonoSucursal"];
    $direccionSucursal = $_POST["direccionSucursal"];
    $emailSucursal = $_POST["emailSucursal"];
    $estatusSucursal = $_POST["estatusSucursal"]; // Agregamos esta línea para obtener el estatus actualizado

    $sql = "UPDATE TSucursal SET EncargadoSuc = ?, TelefonoSuc = ?, DireccionSuc = ?, EmailSuc = ?, IdEstatus = ? WHERE IdSucursal = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $encargadoSucursal, $telefonoSucursal, $direccionSucursal, $emailSucursal, $estatusSucursal, $idSucursal);
    
    if ($stmt->execute()) {
        echo "Sucursal actualizada con éxito.";
    } else {
        echo "Error al actualizar la sucursal: " . $stmt->error;
    }
}
$conn->close();
?>
