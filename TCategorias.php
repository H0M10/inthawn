<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar Categorías</title>
  <link rel="stylesheet" href="Tcategorias.css">
</head>
<body>
  <h1>Gestionar Categorías</h1>

  <h2>Agregar Categoría</h2>
  <form action="agregar_categoria.php" method="POST">
    <label for="nombre">Nombre de la categoría:</label>
    <input type="text" name="nombre" id="nombre" required>

    <label for="descripcion">Descripción:</label>
    <input type="text" name="descripcion" id="descripcion" required>

    <button type="submit">Agregar</button>
  </form>
</body>
</html>
