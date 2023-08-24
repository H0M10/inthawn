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
    $tipoUsuario = $_POST["tipoUsuario"];
    $nombreUsuario = $_POST["nombreUsuario"];
    $correoUsuario = $_POST["correoUsuario"];
    $cuentaUsuario = $_POST["cuentaUsuario"];
    $contrasenaUsuario = $_POST["contrasenaUsuario"];
    $direccionUsuario = $_POST["direccionUsuario"];
    $telefonoUsuario = $_POST["telefonoUsuario"];
    $generoUsuario = $_POST["generoUsuario"];
    $estatusUsuario = $_POST["estatusUsuario"];
    $fechaRegistroUsuario = $_POST["fechaRegistroUsuario"];

    $sql = "UPDATE TUsuario SET TipoUsu = '$tipoUsuario', NombreUsu = '$nombreUsuario', correoUsu = '$correoUsuario', CuentaUsu = '$cuentaUsuario', ContrasenaUsu = '$contrasenaUsuario', DireccionUsu = '$direccionUsuario', TelefonoUsu = '$telefonoUsuario', GeneroUsu = '$generoUsuario', EstatusUsu = '$estatusUsuario', FechaRegistroUsu = '$fechaRegistroUsuario' WHERE IdUsuario = '$idUsuario'";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario actualizado correctamente";
    } else {
        echo "Error al actualizar el usuario: " . $conn->error;
    }
}

$conn->close();
?>
