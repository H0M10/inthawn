<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar Sucursales - Información</title>
  <link rel="stylesheet" href="tsucursales.css">
</head>
<body>
  <h1>Gestionar Sucursales</h1>

  <h2>Listado de Sucursales</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre de la Sucursal</th>
        <th>Teléfono</th>
        <th>Dirección</th>
        <th>Email</th>
        <th>Estatus</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $servername = "localhost";
      $username = "root";
      $password = "hanniel";
      $dbname = "pp";

      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
          die("Conexión fallida: " . $conn->connect_error);
      }

      $sql = "SELECT TSucursal.*, TEstatus.NombreEst 
              FROM TSucursal 
              INNER JOIN TEstatus ON TSucursal.IdEstatus = TEstatus.IdEstatus";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row["IdSucursal"] . "</td>";
              echo "<td>" . $row["TelefonoSuc"] . "</td>";
              echo "<td>" . $row["DireccionSuc"] . "</td>";
              echo "<td>" . $row["EmailSuc"] . "</td>";
              echo "<td>" . $row["NombreEst"] . "</td>";
              echo "<td><a href='3.php?id=" . $row["IdSucursal"] . "'><button>Editar</button></a></td>";
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='7'>No se encontraron sucursales</td></tr>";
      }

      $conn->close();
      ?>
    </tbody>
  </table>
</body>
</html>
