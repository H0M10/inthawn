<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Inventario - Editar Inventario</title>
    <link rel="stylesheet" href="tusuarios.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h1>Gestionar Inventario</h1>

    <h2>Editar Inventario Existente</h2>
    <form id="form-inventario" action="" method="POST">
        <div class="form-group">
            <label for="idInventario">ID del Inventario:</label>
            <input type="text" name="idInventario" id="idInventario" required>
            <button type="button" id="buscar">Buscar</button>
            <button type="submit" id="botonEditar">Editar</button>
        </div>

        <div class="form-group">
            <label for="idProducto">ID del Producto:</label>
            <input type="text" name="idProducto" id="idProducto" readonly required>
        </div>

        <div class="form-group">
            <label for="nombreProd">Nombre del Producto:</label>
            <input type="text" name="nombreProd" id="nombreProd" readonly required>
        </div>

        <div class="form-group">
            <label for="idCategoria">ID de la Categoría:</label>
            <input type="text" name="idCategoria" id="idCategoria" readonly required>
        </div>

        

        <div class="form-group">
            <label for="cantidadInv">Cantidad en Inventario:</label>
            <input type="text" name="cantidadInv" id="cantidadInv" required>
        </div>

        <div class="form-group">
            <label for="idEstatus">ID del Estatus:</label>
            <input type="text" name="idEstatus" id="idEstatus" readonly required>
        </div>

        <div class="form-group">
            <label for="idSucursal">ID de la Sucursal:</label>
            <input type="text" name="idSucursal" id="idSucursal" readonly required>
        </div>

        <!-- Botón "Regresar" -->
        <div class="form-group">
            <button type="button" id="regresar">Regresar</button>
        </div>
    </form>

    <!-- Aquí va el resto de tu código HTML/PHP para mostrar la tabla de inventario y gestionarlo -->

    <script>
        $(document).ready(function () {
            // Función para cargar la información de un inventario mediante Ajax
            function cargarInformacionInventario(idInventario) {
                $.ajax({
                    url: 'buscar_inventario_existente.php',
                    type: 'POST',
                    data: { idInventario: idInventario },
                    dataType: 'json',
                    success: function (data) {
                        if (data.error) {
                            alert(data.error);
                        } else {
                            $("#idProducto").val(data.IdProducto);
                            $("#nombreProd").val(data.NombreProd);
                            $("#idCategoria").val(data.IdCategoria);
                            $("#cantidadInv").val(data.Cantidad);
                            $("#idEstatus").val(data.IdEstatus);
                            $("#idSucursal").val(data.IdSucursal);
                        }
                    },
                    error: function () {
                        alert('Error al realizar la búsqueda.');
                    }
                });
            }

            $("#buscar").click(function () {
                var idInventario = $("#idInventario").val();
                cargarInformacionInventario(idInventario);
            });

            $("#form-inventario").submit(function (e) {
                e.preventDefault();
                var idInventario = $("#idInventario").val();
                var cantidadInv = $("#cantidadInv").val();

                $.ajax({
                    url: 'actualizar_inventario.php',
                    type: 'POST',
                    data: {
                        idInventario: idInventario,
                        cantidadInv: cantidadInv
                    },
                    success: function (data) {
                        alert(data); // Mostrar mensaje de éxito o error
                        cargarInformacionInventario(idInventario); // Recargar la información del inventario después de la actualización
                    },
                    error: function () {
                        alert('Error al actualizar el inventario.');
                    }
                });
            });

            // Agregar el comportamiento al botón "Regresar"
            $("#regresar").click(function () {
                window.location.href = "admin.html"; // Redirigir a la página "admin.html" al hacer clic en "Regresar"
            });
        });
    </script>
</body>

</html>
