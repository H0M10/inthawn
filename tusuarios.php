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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar Usuarios - Agregar Usuario</title>
  <link rel="stylesheet" href="tusuarios.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      padding: 20px;
    }

    h1, h2 {
      margin-bottom: 20px;
      color: #333;
    }

    form {
      margin-bottom: 20px;
    }

    form label {
      display: block;
      margin-bottom: 5px;
      color: #333;
    }

    form input[type="text"],
    form input[type="email"],
    form input[type="password"],
    form input[type="date"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
  </style>
</head>
<body>
  <h1>Gestionar Usuarios</h1>

  <h2>Agregar Usuario</h2>
  <form action="agregar_usuarios.php" method="POST">
    <label for="tipo_usuario">Tipo de usuario:</label>
    <input type="text" name="tipo_usuario" id="tipo_usuario" required>

    <label for="nombre_usuario">Nombre de usuario:</label>
    <input type="text" name="nombre_usuario" id="nombre_usuario" required>

    <label for="correo_usuario">Correo electrónico:</label>
    <input type="email" name="correo_usuario" id="correo_usuario" required>

    <label for="cuenta_usuario">Cuenta de usuario:</label>
    <input type="text" name="cuenta_usuario" id="cuenta_usuario" required>

    <label for="contrasena_usuario">Contraseña:</label>
    <input type="password" name="contrasena_usuario" id="contrasena_usuario" required>

    <label for="direccion_usuario">Dirección:</label>
    <input type="text" name="direccion_usuario" id="direccion_usuario" required>

    <label for="telefono_usuario">Teléfono:</label>
    <input type="text" name="telefono_usuario" id="telefono_usuario" required>

    <label for="genero_usuario">Género:</label>
    <select name="genero_usuario" id="genero_usuario" required>
      <option value="M">M</option>
      <option value="F">F</option>
    </select>

    <button type="submit">Agregar</button>
  </form>

  <?php
  $conn->close();
  ?>
</body>
</html>
