<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Categorías - Información</title>
    <link rel="stylesheet" href="Tcategorias.css">
</head>
<body>
    <h1>Gestionar Categorías</h1>

    <h2>Listado de Categorías</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Conexión a la base de datos
            $servername = "localhost";
            $username = "root";
            $password = "hanniel";
            $dbname = "AA";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta los registros/categorías de la base de datos
            $sql = "SELECT * FROM TCategorias";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Muestra los registros en filas de la tabla
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["IdCategoria"] . "</td>";
                    echo "<td>" . $row["NombreCat"] . "</td>";
                    echo "<td>" . $row["DescripcionCat"] . "</td>";
                    echo "<td><a href='editar_categoria.php?id=" . $row["IdCategoria"] . "' class='editar-btn'>Editar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No se encontraron categorías</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
