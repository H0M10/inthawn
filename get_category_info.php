<?php
if (isset($_POST['categoryId'])) {
    // Obtener el ID de la categoría enviado por la petición AJAX
    $categoryId = $_POST['categoryId'];

    // Conexión a la base de datos (reemplaza los valores con los de tu base de datos)
    $servername = "localhost";
    $username = "root";
    $password = "hanniel";
    $dbname = "pp";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta la información de la categoría específica en la base de datos
    $sql = "SELECT * FROM TCategorias WHERE IdCategoria = '$categoryId'";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    // Genera el formulario HTML con los campos para editar la información
    $form = '<label for="category-name">Nombre:</label>';
    $form .= '<input type="text" id="category-name" name="category-name" value="' . $row["NombreCat"] . '">';
    $form .= '<label for="category-description">Descripción:</label>';
    $form .= '<textarea id="category-description" name="category-description">' . $row["DescripcionCat"] . '</textarea>';
    $form .= '<input type="submit" value="Guardar">';

    $conn->close();

    // Devuelve el formulario HTML en la respuesta
    echo $form;
}
?>
