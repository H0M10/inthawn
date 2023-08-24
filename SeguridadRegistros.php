<?php

$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "AA";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$cuenta = $_POST['cuenta'];
$correo = $_POST['correo'];
$pass = $_POST['contraseña'];
$telefono = $_POST['telefono'];
$genero = $_POST['genero'];
$direccion = $_POST['direccion'];
$fecha = date("Y-m-d");

$checkNombre = "SELECT * FROM TUsuario WHERE NombreUsu = '$nombre'";
$checkCorreo = "SELECT * FROM TUsuario WHERE CorreoUsu = '$correo'";
$checkCuenta = "SELECT * FROM TUsuario WHERE CuentaUsu = '$cuenta'";

$resultNombre = $conn->query($checkNombre);
$resultCorreo = $conn->query($checkCorreo);
$resultCuenta = $conn->query($checkCuenta);

if ($resultNombre->num_rows > 0) {
    header("Location: registros.html?error=El nombre de usuario ya existe.");
    exit();
}
if ($resultCorreo->num_rows > 0) {
    header("Location: registros.html?error=El correo ya está registrado.");
    exit();
}
if ($resultCuenta->num_rows > 0) {
    header("Location: registros.html?error=La cuenta ya existe.");
    exit();
}

$sql = "INSERT INTO TUsuario (IdUsuario, IdTipo, NombreUsu, CorreoUsu, CuentaUsu, ContrasenaUsu, DireccionUsu, TelefonoUsu, GeneroUsu, IdEstatus, FechaRegistroUsu)
        VALUES (?, '3', ?, ?, ?, ?, ?, ?, ?, '1', ?)";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('prepare() failed: ' . htmlspecialchars($conn->error));
}

if (!$stmt->bind_param('sssssssss', $IdUsuario, $nombre, $correo, $cuenta, $pass, $direccion, $telefono, $genero, $fecha)) {
    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}


if (!$stmt->execute()) {
    die('execute() failed: ' . htmlspecialchars($stmt->error));
}

echo "New record created successfully";

$stmt->close();

$last_id = $conn->insert_id;

session_start();
$_SESSION['loggedin'] = true;
$_SESSION['user'] = ['IdUsuario' => $last_id];

$conn->close();

header('Location: registros.html');

?>