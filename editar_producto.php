<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "aa";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos enviados por POST
$idProducto = $_POST['idProducto'];
$nombreProducto = $_POST['nombreProducto'];
$idCategoria = $_POST['idCategoria'];
$precio = $_POST['precio'];

// Consulta SQL para actualizar el producto en la tabla TProductos
$sqlProducto = "UPDATE TProductos 
                SET NombreProd = '$nombreProducto', 
                    IdCategoria = '$idCategoria', 
                    Precio = '$precio' 
                WHERE IdProducto = '$idProducto'";

// Ejecutar la consulta
if ($conn->query($sqlProducto) === TRUE) {
    echo "Producto actualizado correctamente";
} else {
    echo "Error al actualizar el producto: " . $conn->error;
}

$conn->close();
?>
