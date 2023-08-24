<?php
$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "AA";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombreSuc = $_POST["nombreSuc"];
$telefonoSuc = $_POST["telefonoSuc"];
$direccionSuc = $_POST["direccionSuc"];
$emailSuc = $_POST["emailSuc"];

// Puedes establecer el IdEstatus a un valor predeterminado, por ejemplo 1, si ese es el ID que corresponde al estatus "activo".
$idEstatus = 1; 

// Insertar la nueva sucursal en la base de datos
$sql = "INSERT INTO TSucursal (NombreSuc, TelefonoSuc, DireccionSuc, EmailSuc, IdEstatus)
        VALUES ('$nombreSuc', '$telefonoSuc', '$direccionSuc', '$emailSuc', '$idEstatus')";

if ($conn->query($sql) === TRUE) {
    echo "Sucursal agregada correctamente.";
} else {
    echo "Error al agregar la sucursal: " . $conn->error;
}

$conn->close();
?>
