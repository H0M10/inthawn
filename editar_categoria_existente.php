<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "AA"; // Cambio a la nueva base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idCategoria = $_POST["idCategoria"];
    $nombreCategoria = $_POST["nombreCategoria"];
    $descripcionCategoria = $_POST["descripcionCategoria"];
   
    $nombreCategoria = $conn->real_escape_string($nombreCategoria);
    $descripcionCategoria = $conn->real_escape_string($descripcionCategoria);
    $idCategoria = intval($idCategoria); // Asegurarse de que es un entero
    
    $sql = "UPDATE TCategorias SET NombreCat = '$nombreCategoria', DescripcionCat = '$descripcionCategoria' WHERE IdCategoria = $idCategoria";
    if ($conn->query($sql) === TRUE) {
        echo "Categoría actualizada con éxito.";
    } else {
        echo "Error al actualizar la categoría: " . $conn->error;
    }
    
}
$conn->close();
?>
