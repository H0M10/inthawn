<?php
$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "pp";

// Creamos la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificamos la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
