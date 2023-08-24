<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar Productos - Información</title>
  <link rel="stylesheet" href="tproductos.css">
</head>
<body>
  <h1>Gestionar Productos</h1>

  <h2>Listado de Productos</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $servername = "localhost";
      $username = "root";
      $password = "hanniel";
      $dbname = "AA"; // Cambio a "AA" de acuerdo a lo mencionado

      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
          die("Conexión fallida: " . $conn->connect_error);
      }

      $registrosPorPagina = 10;
      $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
      $offset = ($paginaActual - 1) * $registrosPorPagina;

      $sql = "SELECT TProductos.*, TCategorias.NombreCat
        FROM TProductos 
        INNER JOIN TCategorias ON TProductos.IdCategoria = TCategorias.IdCategoria 
        LIMIT $offset, $registrosPorPagina";

$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error); // Mostrará el error si la consulta falla
}

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["IdProducto"] . "</td>";
        echo "<td>" . $row["NombreProd"] . "</td>";
        echo "<td>" . $row["NombreCat"] . "</td>";
        echo "<td>" . $row["Precio"] . "</td>";
        
        echo "<td><a href='2.php?id=" . $row["IdProducto"] . "'><button>Editar</button></a>";
        echo "<a href='eliminar.2?id=" . $row["IdProducto"] . "'><button>Eliminar</button></a></td>";

        echo "</tr>";
    }

    $sqlTotalRegistros = "SELECT COUNT(*) AS total FROM TProductos";
    $resultTotalRegistros = $conn->query($sqlTotalRegistros);
    $rowTotalRegistros = $resultTotalRegistros->fetch_assoc();
    $totalRegistros = $rowTotalRegistros['total'];

    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
    
    echo "<tfoot><tr><td colspan='7'><div class='pagination'>";
    for ($i = 1; $i <= $totalPaginas; $i++) {
        echo "<a href='?pagina=$i'>$i</a> ";
    }
    echo "</div></td></tr></tfoot>";
} else {
    echo "<tr><td colspan='7'>No se encontraron productos</td></tr>";
}

$conn->close();

      ?>
    </tbody>
  </table>
</body>
</html>
