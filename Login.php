<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "AA";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['contraseña'];

    $stmt = $conn->prepare('SELECT * FROM TUsuario WHERE CuentaUsu = ? OR CorreoUsu = ?');
    $stmt->bind_param("ss", $usuario, $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row && $password === $row['ContrasenaUsu']) {
        $_SESSION['loggedin'] = true;
        $_SESSION['user'] = $row;

       
        if ($row['IdTipo'] == 1 || $row['IdTipo'] == 2) {
            header("Location: admin.php");
        } else if ($row['IdTipo'] == 3) {

             // Comprobar si el usuario tiene una sucursal asignada
        if (is_null($row['IdSucursalSeleccionada'])) {
            header("Location: /Pagina/privado/seleccionarSucursal.php?message=Antes de iniciar tus compras, necesitas escoger la sucursal de tu conveniencia.");
            exit();
        }
            header("Location: /Pagina/privado/index.php");
        }
        exit;
    } else {
        $mensaje = "Nombre de usuario o contraseña incorrectos";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link href="Estilos/login.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <form action="login.php" method="POST">
        <h3>Iniciar sesión</h3>

        <label for="usuario">Usuario o Correo</label>
        <input type="text" placeholder="Nombre de usuario o correo" id="usuario" name="usuario" required>

        <label for="contraseña">Contraseña</label>
        <input type="password" placeholder="Contraseña" id="contraseña" name="contraseña" required>

        <button type="submit" class="login-button">Entrar</button>
        <button type="button" class="register-button" onclick="window.location.href='registros.html';">Registrar</button>

        <?php if (isset($mensaje)) { ?>
            <p><?php echo $mensaje; ?></p>
        <?php } ?>

        <a href="recuperarpass.php" class="btn btn-primary">Recuperar Contraseña</a>
    </form>

    <script>
        // Agregar un evento click al botón "Registrar" para redirigir a la página de registro
        document.querySelector('.register-button').addEventListener('click', function() {
            window.location.href = 'registros.html'; // Cambia "registros.html" por la ruta de tu página de registro
        });
    </script>
</body>
</html>
