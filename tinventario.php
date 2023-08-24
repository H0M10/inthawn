<?php
$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "AA";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta los registros de inventario en la base de datos
$sql = "SELECT TInventario.*, TProductos.NombreProd, TProductos.Precio AS PrecioUnitarioProd, TProductos.IdCategoria 
        FROM TInventario 
        JOIN TProductos ON TInventario.IdProducto = TProductos.IdProducto";
$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar Inventario</title>
</head>
<body>
  <h1>Gestionar Inventario</h1>

  <h2>Listado de Productos</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>ID de Producto</th>
        <th>Nombre del Producto</th>
        <th>ID de Categoría</th>
        <th>Precio Unitario del Producto</th>
        <th>Cantidad en Inventario</th>
        <th>ID de Estatus</th>
        <th>ID de Sucursal</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["IdInventario"] . "</td>";
            echo "<td>" . $row["IdProducto"] . "</td>";
            echo "<td>" . $row["NombreProd"] . "</td>";
            echo "<td>" . $row["IdCategoria"] . "</td>";
            echo "<td>" . $row["PrecioUnitarioProd"] . "</td>";
            echo "<td>" . $row["Cantidad"] . "</td>";  // Asumiendo que la columna se llama 'Cantidad' en 'TInventario'
            echo "<td>" . $row["IdEstatus"] . "</td>";
            echo "<td>" . $row["IdSucursal"] . "</td>";
            echo "<td><a href='gestionar_inventario.php?id=" . $row["IdInventario"] . "'><button>Gestionar Inventario</button></a></td>";
            echo "</tr>";
        }
      } else {
          echo "<tr><td colspan='9'>No se encontraron productos en el inventario</td></tr>";
      }

      $conn->close();
      ?>
    </tbody>
  </table>
</body>
</html>
