<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar Sucursales - Editar</title>
  <link rel="stylesheet" href="Tcategorias.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <h1>Gestionar Sucursales</h1>

  <h2>Editar Sucursales Existentes</h2>
  <form id="form-sucursal" action="" method="POST">
    <div class="form-group">
      <label for="idSucursal">ID de la Sucursal:</label>
      <input type="text" name="idSucursal" id="idSucursal" required>
      <button type="button" id="buscar">Buscar</button>
      <button type="submit" id="botonEditar">Editar</button>
    </div>

    <div class="form-group">
      <label for="nombreSucursal">Nombre de la Sucursal:</label>
      <input type="text" name="nombreSucursal" id="nombreSucursal">
    </div>

    <div class="form-group">
      <label for="telefonoSucursal">Teléfono:</label>
      <input type="text" name="telefonoSucursal" id="telefonoSucursal">
    </div>

    <div class="form-group">
      <label for="direccionSucursal">Dirección:</label>
      <input type="text" name="direccionSucursal" id="direccionSucursal">
    </div>

    <div class="form-group">
      <label for="emailSucursal">Email:</label>
      <input type="email" name="emailSucursal" id="emailSucursal">
    </div>

    <div class="form-group">
      <label for="estatusSucursal">Estatus:</label>
      <select name="estatusSucursal" id="estatusSucursal">
        <option value="Es1">Es1</option>
        <option value="Es2">Es2</option>
      </select>
    </div>

    <div class="form-group">
      <button type="button" id="regresar">Regresar</button>
    </div>
  </form>

  <script>
    $(document).ready(function() {
      // Función para buscar una sucursal por ID y cargar sus datos en el formulario
      $("#buscar").click(function() {
        var idSucursal = $("#idSucursal").val();
        $.ajax({
          url: 'buscar_sucursal_existente.php',
          type: 'POST',
          data: { idSucursal: idSucursal },
          dataType: 'json',
          success: function(data) {
            if (data.error) {
              alert(data.error);
            } else {
              $("#nombreSucursal").val(data.NombreSuc);
              $("#telefonoSucursal").val(data.TelefonoSuc);
              $("#direccionSucursal").val(data.DireccionSuc);
              $("#emailSucursal").val(data.EmailSuc);
              $("#estatusSucursal").val(data.IdEstatus);
            }
          },
          error: function() {
            alert('Error al realizar la búsqueda.');
          }
        });
      });

      // Función para editar una sucursal
      $("#botonEditar").click(function(e) {
        e.preventDefault();
        // Obtener valores del formulario
        var idSucursal = $("#idSucursal").val();
        var nombreSucursal = $("#nombreSucursal").val();
        var telefonoSucursal = $("#telefonoSucursal").val();
        var direccionSucursal = $("#direccionSucursal").val();
        var emailSucursal = $("#emailSucursal").val();
        var estatusSucursal = $("#estatusSucursal").val();

        // Llamada AJAX para editar la sucursal
        $.ajax({
          url: 'editar_sucursal_existente.php',
          type: 'POST',
          data: {
            idSucursal: idSucursal,
            nombreSucursal: nombreSucursal,
            telefonoSucursal: telefonoSucursal,
            direccionSucursal: direccionSucursal,
            emailSucursal: emailSucursal,
            estatusSucursal: estatusSucursal
          },
          success: function(data) {
            alert(data); // Mostrar mensaje de éxito o error
          },
          error: function() {
            alert('Error al editar la sucursal.');
          }
        });
      });

      // Regresar al menú principal
      $("#regresar").click(function() {
        window.location.href = "admin.html";
      });
    });
  </script>
</body>

</html>
