<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar Sucursales - Agregar Sucursal</title>
  <link rel="stylesheet" href="tsucursales.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <h1>Gestionar Sucursales</h1>

  <h2>Agregar Sucursal</h2>
  <form action="agregar_sucursal.php" method="POST">
    <div class="form-group">
      <label for="nombreSuc">Nombre de la Sucursal:</label>
      <input type="text" name="nombreSuc" id="nombreSuc" required>
    </div>

    <div class="form-group">
      <label for="telefonoSuc">Teléfono de la Sucursal:</label>
      <input type="text" name="telefonoSuc" id="telefonoSuc" required>
    </div>

    <div class="form-group">
      <label for="direccionSuc">Dirección de la Sucursal:</label>
      <input type="text" name="direccionSuc" id="direccionSuc" required>
    </div>

    <div class="form-group">
      <label for="emailSuc">Email de la Sucursal:</label>
      <input type="email" name="emailSuc" id="emailSuc" required>
    </div>

    <div class="form-group">
      <button type="submit">Agregar</button>
    </div>
  </form>
</body>
</html>
