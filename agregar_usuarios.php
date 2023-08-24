<?php
$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "AA"; // Usando AA como nombre de BD

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$IdTipo = intval($_POST['tipo_usuario']);
$NombreUsu = $_POST['nombre_usuario'];
$CorreoUsu = $_POST['correo_usuario'];
$CuentaUsu = $_POST['cuenta_usuario'];
$ContrasenaUsu = $_POST['contrasena_usuario'];
$DireccionUsu = $_POST['direccion_usuario'];
$TelefonoUsu = $_POST['telefono_usuario'];
$GeneroUsu = $_POST['genero_usuario'];
$EstatusUsu = 1; // Valor por defecto
$FechaRegistroUsu = date("Y-m-d");

$sql = "INSERT INTO TUsuario (IdTipo, NombreUsu, correoUsu, CuentaUsu, ContrasenaUsu, DireccionUsu, TelefonoUsu, GeneroUsu, IdEstatus, FechaRegistroUsu) 
        VALUES ('$IdTipo', '$NombreUsu', '$CorreoUsu', '$CuentaUsu', '$ContrasenaUsu', '$DireccionUsu', '$TelefonoUsu', '$GeneroUsu', '$EstatusUsu', '$FechaRegistroUsu')";

if ($conn->query($sql) === TRUE) {
    echo "Usuario agregado exitosamente";
} else {
    echo "Error al agregar el usuario: " . $conn->error;
}

$conn->close();
?>
