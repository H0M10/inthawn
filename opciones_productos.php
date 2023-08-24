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

// Consulta para obtener los ID de los productos
$sql = "SELECT IdProducto FROM TProductos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar los datos de cada fila
    while($row = $result->fetch_assoc()) {
        echo '<option value="'.$row["IdProducto"].'">'.$row["IdProducto"].'</option>';
    }
} else {
    echo "No se encontraron productos";
}

$conn->close();
?>
