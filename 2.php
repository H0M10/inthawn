<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Productos - Información</title>
    <link rel="stylesheet" href="tproductos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h1>Gestionar Productos</h1>

    <h2>Editar Producto Existente</h2>
    <form id="form-producto" action="" method="POST">
        <div class="form-group">
            <label for="idProducto">ID del Producto:</label>
            <input type="text" name="idProducto" id="idProducto" required>
            <button type="button" id="buscar">Buscar</button>
            <button type="submit" id="botonEditar">Editar</button>
        </div>

        <div class="form-group">
            <label for="nombreProducto">Nombre:</label>
            <input type="text" name="nombreProducto" id="nombreProducto">
        </div>


        <div class="form-group">
            <label for="idCategoria">Categoría:</label>
            <input type="text" name="idCategoria" id="idCategoria">
        </div>

        <div class="form-group">
            <label for="precio">Precio Unitario:</label>
            <input type="text" name="precio" id="precio">
        </div>

        <!-- Botón "Regresar" -->
        <div class="form-group">
            <button type="button" id="regresar">Regresar</button>
        </div>
    </form>

    <!-- Aquí va el resto de tu código HTML/PHP para mostrar la tabla de productos y gestionarlos -->

    <script>
        $(document).ready(function() {
            // Función para cargar las opciones mediante Ajax
            function cargarOpciones(url, selectId) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data && data.length > 0) {
                            var options = '';
                            data.forEach(function(item) {
                                options += '<option value="' + item.Id + '">' + item.Nombre + '</option>';
                            });
                            $(selectId).html(options);
                        }
                    },
                });
            }

            $("#buscar").click(function() {
                var idProducto = $("#idProducto").val();
                $.ajax({
                    url: 'buscar_producto_existente.php',
                    type: 'POST',
                    data: { idProducto: idProducto },
                    dataType: 'json',
                    success: function(data) {
                        if (data.error) {
                            alert(data.error);
                        } else {
                            $("#nombreProducto").val(data.NombreProd);
                            $("#idCategoria").val(data.IdCategoria);
                            $("#precio").val(data.Precio);
                        }
                    },
                    error: function() {
                        alert('Error al realizar la búsqueda.');
                    }
                });

                // Cargar opciones de categoría
                cargarOpciones('cargar_categorias.php', '#idCategoria');
            });

            $("#botonEditar").click(function(e) {
                e.preventDefault();
                var idProducto = $("#idProducto").val();
                var nombreProducto = $("#nombreProducto").val();
                var idCategoria = $("#idCategoria").val();
                var precio = $("#precio").val();
                $.ajax({
                    url: 'editar_producto.php',
                    type: 'POST',
                    data: {
                        idProducto: idProducto,
                        nombreProducto: nombreProducto,
                        idCategoria: idCategoria,
                        precio: precio
                    },
                    success: function(data) {
                        alert(data);
                    },
                    error: function() {
                        alert('Error al editar el producto.');
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
