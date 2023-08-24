<?php
// Conexión a la base de datos (reemplaza los valores con los de tu base de datos)
$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "AA";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta las opciones de sucursal desde la tabla TSucursal
$sql = "SELECT IdSucursal FROM TSucursal";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Genera las opciones de sucursal
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["IdSucursal"] . "'>" . $row["IdSucursal"] . "</option>";
    }
}

$conn->close();
?>
