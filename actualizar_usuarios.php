<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar Usuarios - Actualizar Usuario</title>
  <link rel="stylesheet" href="tusuarios.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <h1>Gestionar Usuarios</h1>

  <h2>Editar Usuario Existente</h2>
  <form id="form-usuario" action="" method="POST">
    <div class="form-group">
      <label for="idUsuario">ID del Usuario:</label>
      <input type="text" name="idUsuario" id="idUsuario" required>
      <button type="button" id="buscar">Buscar</button>
      <button type="submit" id="botonEditar">Editar</button>
    </div>

    <div class="form-group">
      <label for="tipoUsuario">Tipo:</label>
      <input type="text" name="tipoUsuario" id="tipoUsuario">
    </div>

    <div class="form-group">
      <label for="nombreUsuario">Nombre:</label>
      <input type="text" name="nombreUsuario" id="nombreUsuario">
    </div>

    <div class="form-group">
      <label for="correoUsuario">Correo:</label>
      <input type="text" name="correoUsuario" id="correoUsuario">
    </div>

    <div class="form-group">
      <label for="cuentaUsuario">Cuenta:</label>
      <input type="text" name="cuentaUsuario" id="cuentaUsuario">
    </div>

    <div class="form-group">
      <label for="contrasenaUsuario">Contraseña:</label>
      <input type="password" name="contrasenaUsuario" id="contrasenaUsuario">
    </div>

    <div class="form-group">
      <label for="direccionUsuario">Dirección:</label>
      <input type="text" name="direccionUsuario" id="direccionUsuario">
    </div>

    <div class="form-group">
      <label for="telefonoUsuario">Teléfono:</label>
      <input type="text" name="telefonoUsuario" id="telefonoUsuario">
    </div>

    <div class="form-group">
      <label for="generoUsuario">Género:</label>
      <input type="text" name="generoUsuario" id="generoUsuario">
    </div>

    <div class="form-group">
      <label for="estatusUsuario">Estatus:</label>
      <input type="text" name="estatusUsuario" id="estatusUsuario">
    </div>

    <div class="form-group">
      <label for="fechaRegistroUsuario">Fecha de Registro:</label>
      <input type="text" name="fechaRegistroUsuario" id="fechaRegistroUsuario">
    </div>

    <!-- Botón "Regresar" -->
    <div class="form-group">
      <button type="button" id="regresar">Regresar</button>
    </div>
  </form>

  <!-- Aquí va el resto de tu código HTML/PHP para mostrar la tabla de usuarios y gestionarlos -->

  <script>
    $(document).ready(function() {
      // Función para cargar la información de un usuario mediante Ajax
      function cargarInformacionUsuario(idUsuario) {
        $.ajax({
          url: 'buscar_usuario_existente.php',
          type: 'POST',
          data: { idUsuario: idUsuario },
          dataType: 'json',
          success: function(data) {
            if (data.error) {
              alert(data.error);
            } else {
              $("#tipoUsuario").val(data.TipoUsu);
              $("#nombreUsuario").val(data.NombreUsu);
              $("#correoUsuario").val(data.correoUsu);
              $("#cuentaUsuario").val(data.CuentaUsu);
              $("#direccionUsuario").val(data.DireccionUsu);
              $("#telefonoUsuario").val(data.TelefonoUsu);
              $("#generoUsuario").val(data.GeneroUsu);
              $("#estatusUsuario").val(data.EstatusUsu);
              $("#fechaRegistroUsuario").val(data.FechaRegistroUsu);
            }
          },
          error: function() {
            alert('Error al realizar la búsqueda.');
          }
        });
      }

      $("#buscar").click(function() {
        var idUsuario = $("#idUsuario").val();
        cargarInformacionUsuario(idUsuario);
      });

      $("#botonEditar").click(function(e) {
        e.preventDefault();
        var idUsuario = $("#idUsuario").val();
        var tipoUsuario = $("#tipoUsuario").val();
        var nombreUsuario = $("#nombreUsuario").val();
        var correoUsuario = $("#correoUsuario").val();
        var cuentaUsuario = $("#cuentaUsuario").val();
        var contrasenaUsuario = $("#contrasenaUsuario").val();
        var direccionUsuario = $("#direccionUsuario").val();
        var telefonoUsuario = $("#telefonoUsuario").val();
        var generoUsuario = $("#generoUsuario").val();
        var estatusUsuario = $("#estatusUsuario").val();
        var fechaRegistroUsuario = $("#fechaRegistroUsuario").val();

        $.ajax({
          url: 'editar_usuario.php',
          type: 'POST',
          data: {
            idUsuario: idUsuario,
            tipoUsuario: tipoUsuario,
            nombreUsuario: nombreUsuario,
            correoUsuario: correoUsuario,
            cuentaUsuario: cuentaUsuario,
            contrasenaUsuario: contrasenaUsuario,
            direccionUsuario: direccionUsuario,
            telefonoUsuario: telefonoUsuario,
            generoUsuario: generoUsuario,
            estatusUsuario: estatusUsuario,
            fechaRegistroUsuario: fechaRegistroUsuario
          },
          success: function(data) {
            alert(data); // Mostrar mensaje de éxito o error
          },
          error: function() {
            alert('Error al editar el usuario.');
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