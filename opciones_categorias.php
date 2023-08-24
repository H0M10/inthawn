<?php
// Conexión a la base de datos (reemplaza los valores con los de tu base de datos)
$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "AA";  // Nota: Cambié 'pp' a 'AA' basándome en tu información anterior.

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta las opciones de categoría desde la tabla TCategorias
$sql = "SELECT IdCategoria, NombreCat FROM TCategorias";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Genera las opciones de categoría
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["IdCategoria"] . "'>" . $row["NombreCat"] . "</option>";
    }
}

$conn->close();
?>
