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

// Consulta los registros de usuarios en la base de datos
$sql = "SELECT * FROM TUsuario";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar Usuarios - Información de Usuarios</title>
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

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table th,
    table td {
      padding: 10px;
      border-bottom: 1px solid #ccc;
    }

    table th {
      background-color: #f2f2f2;
      color: #333;
      font-weight: bold;
      text-align: left;
    }

    table td {
      color: #666;
    }

    .no-data {
      text-align: center;
      color: #666;
      padding: 10px;
    }
  </style>
</head>
<body>
  <h1>Gestionar Usuarios</h1>

  <h2>Listado de Usuarios</h2>
  <?php
  if ($result->num_rows > 0) {
  ?>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Tipo</th>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Cuenta</th>
          <th>Dirección</th>
          <th>Teléfono</th>
          <th>Género</th>
          <th>Estatus</th>
          <th>Fecha de Registro</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["IdUsuario"] . "</td>";
          echo "<td>" . $row["TipoUsu"] . "</td>";
          echo "<td>" . $row["NombreUsu"] . "</td>";
          echo "<td>" . $row["correoUsu"] . "</td>";
          echo "<td>" . $row["CuentaUsu"] . "</td>";
          echo "<td>" . $row["DireccionUsu"] . "</td>";
          echo "<td>" . $row["TelefonoUsu"] . "</td>";
          echo "<td>" . $row["GeneroUsu"] . "</td>";
          echo "<td>" . $row["EstatusUsu"] . "</td>";
          echo "<td>" . $row["FechaRegistroUsu"] . "</td>";
          
          // Agregar el botón "Editar" que redirige a actualizar_usuario.php con el ID del usuario como parámetro
          echo "<td><a href='actualizar_usuarios.php?id=" . $row["IdUsuario"] . "'><button>Editar</button></a></td>";
          
          echo "</tr>";
      }
        ?>
      </tbody>
    </table>
  <?php
  } else {
  ?>
    <p class="no-data">No se encontraron usuarios</p>
  <?php
  }
  $conn->close();
  ?>
</body>
</html>
