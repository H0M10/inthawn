<?php
$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "AA"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar Productos</title>
  <link rel="stylesheet" href="tproductos.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // ... (el resto del código del script)
  </script>
</head>
<body>
  <h1>Gestionar Productos</h1>

  <h2>Agregar Producto</h2>
  <form action="agregar_producto.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="nombre">Nombre del producto:</label>
      <input type="text" name="nombre" id="nombre" required>
    </div>

    <div class="form-group">
      <label for="descripcion">Descripción:</label>
      <input type="text" name="descripcion" id="descripcion" required>
    </div>



   <div class="forsm-group">
  <label for="idCategoria">Categoría:</label>
  <select name="idCategoria" id="idCategoria" required>
    <option value="">Seleccionar Categoría</option>
    
  </select>
</div>

    


    <div class="form-group">
      <label for="idEstatus">Estatus:</label>
      <select name="idEstatus" id="idEstatus" required>
        <option value="">Seleccionar Estatus</option>
      </select>
    </div>

    <div class="form-group">
      <label for="precio">Precio Unitario:</label>
      <input type="text" name="precio" id="precio" required>
    </div>

    <div class="form-group">
      <label for="imagen">Imagen:</label>
      <input type="file" name="imagen" id="imagen" required>
    </div>

    <div class="form-group">
      <button type="submit">Agregar</button>
    </div>
  </form>
</body>
</html>
