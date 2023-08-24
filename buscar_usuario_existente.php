<?php
$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "pp";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = $_POST["idUsuario"];

    $sql = "SELECT * FROM TUsuario WHERE IdUsuario = '$idUsuario'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(array("error" => "Usuario no encontrado"));
    }
}

$conn->close();
?>
