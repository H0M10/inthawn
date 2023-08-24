
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link href="Estilos/login.css" rel="stylesheet" type="text/css"></head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1>Recuperar Contraseña</h1>
                <form action="recuperarpass.php" method="post">
                    <div class="form-group">
                        <label for="email">Correo electrónico:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
                <?php
                    // Aquí irá la lógica en PHP para validar y enviar la contraseña
                ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['email'];

    // Conexión a la base de datos (actualiza estos valores según tu configuración)
    $servername = "localhost";
    $username = "root";
    $password = "hanniel";
    $dbname = "pp";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "SELECT ContrasenaUsu FROM TUsuario WHERE correoUsu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->bind_result($contrasena);
    $stmt->fetch();

    if ($contrasena) {
        // Enviar la contraseña por correo electrónico
        $to = $correo;
        $subject = "Recuperación de Contraseña";
        $message = "Tu contraseña es: " . $contrasena;
        $headers = "From: 2022371026@UTEQ.EDU.MX";

        mail($to, $subject, $message, $headers);

        echo "<div class='alert alert-success'>Realizado con éxito.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: Correo electrónico no encontrado.</div>";
    }

    $stmt->close();
    $conn->close();
}
?>
