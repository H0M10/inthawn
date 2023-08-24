<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar Categorías - Información</title>
  <link rel="stylesheet" href="Tcategorias.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <h1>Gestionar Categorías</h1>

  <form id="form-categoria" action="" method="POST">
    <div class="form-group">
      <label for="idCategoria">ID de la Categoría:</label>
      <input type="text" name="idCategoria" id="idCategoria" required>
      <button type="button" id="buscar">Buscar</button>
      <button type="submit" id="botonEditar">Editar</button>
    </div>

    <div class="form-group">
      <label for="nombreCategoria">Nombre:</label>
      <input type="text" name="nombreCategoria" id="nombreCategoria">
    </div>

    <div class="form-group">
      <label for="descripcionCategoria">Descripción:</label>
      <input type="text" name="descripcionCategoria" id="descripcionCategoria">
    </div>


    <!-- Botón "Regresar" -->
    <div class="form-group">
      <button type="button" id="regresar">Regresar</button>
    </div>
  </form>

  <!-- Aquí va el resto de tu código HTML/PHP... -->

  <script>
    $(document).ready(function() {
      $("#buscar").click(function() {
        var idCategoria = $("#idCategoria").val();
        $.ajax({
          url: 'buscar_categoria_existente.php',
          type: 'POST',
          data: { idCategoria: idCategoria },
          dataType: 'json',
          success: function(data) {
            if (data.error) {
              alert(data.error);
            } else {
              $("#nombreCategoria").val(data.NombreCat);
              $("#descripcionCategoria").val(data.DescripcionCat);
            }
          },
          error: function() {
            alert('Error al realizar la búsqueda.');
          }
        });
      });

      $("#botonEditar").click(function(e) {
        e.preventDefault();
        var idCategoria = $("#idCategoria").val();
        var nombreCategoria = $("#nombreCategoria").val();
        var descripcionCategoria = $("#descripcionCategoria").val();

        $.ajax({
          url: 'editar_categoria_existente.php',
          type: 'POST',
          data: {
            idCategoria: idCategoria,
            nombreCategoria: nombreCategoria,
            descripcionCategoria: descripcionCategoria,
          },
          success: function(data) {
            alert(data); // Mostrar mensaje de éxito o error
          },
          error: function() {
            alert('Error al editar la categoría.');
          }
        });
      });

      // Agregar el comportamiento al botón "Regresar"
      $("#regresar").click(function() {
        window.location.href = "admin.html"; // Redirigir a la página "admin.html" al hacer clic en "Regresar"
      });
    });
  </script>
</body>

</html>
