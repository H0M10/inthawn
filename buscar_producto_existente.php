<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "AA";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si la solicitud es una petición AJAX
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // Obtener el ID del producto desde la solicitud POST
    $idProducto = $_POST['idProducto'];

    // Consulta SQL para obtener toda la información del producto basado en el ID
    $sql = "SELECT IdProducto, NombreProd, IdCategoria, Precio, RutaImagen FROM TProductos WHERE IdProducto = '$idProducto'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Producto encontrado, devolver los datos en formato JSON
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        // Producto no encontrado, devolver un mensaje de error en formato JSON
        echo json_encode(array('error' => 'Producto no encontrado'));
    }
} else {
    // Si no es una petición AJAX, redirigir a otra página (puedes cambiar la dirección de redirección)
    header('Location: otra_pagina.php');
}

$conn->close();
?>
