<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "hanniel";
    $dbname = "AA"; // Cambio a la nueva base de datos

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $nombre = $_POST["nombre"];
    $idCategoria = intval($_POST["idCategoria"]); // Convertir a entero
    $precio = $_POST["precio"];

    // Consultar el nombre de la categoría a partir del idCategoria
    $sql_categoria = "SELECT NombreCat FROM TCategorias WHERE IdCategoria = '$idCategoria'";
    $result_categoria = $conn->query($sql_categoria);

    if ($result_categoria->num_rows > 0) {
        $row_categoria = $result_categoria->fetch_assoc();
        $nombre_categoria = $row_categoria["NombreCat"];
    } else {
        echo "Categoría no encontrada o ID de categoría inválido.";
        exit;
    }

    // Carpeta donde se guardan las imágenes específicas para la categoría
    $carpeta_base = "C:/xampp/htdocs/Pagina/privado/img/" . $nombre_categoria . "/";
    
    // Obtener todas las imágenes de la carpeta correspondiente a la categoría
    $imagenes = glob($carpeta_base . "*.jpg");
    $total_imagenes = "0" . (count($imagenes) + 1);
    
    // Generar el siguiente ID de producto
    $sql_count = "SELECT COUNT(*) AS total FROM TProductos";
    $result_count = $conn->query($sql_count);
    $total_rows = $result_count->fetch_assoc()["total"];
    $nextId = $total_rows + 1; // El ID es ahora un entero

    // Manejar la subida de la imagen y moverla al destino final con el nuevo nombre
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $carpeta_base . $total_imagenes . ".jpg")) {
        // Guardar los datos en la base de datos
        $sql = "INSERT INTO TProductos (NombreProd, IdCategoria, Precio, RutaImagen) VALUES 
                ('$nombre', $idCategoria, $precio, './img/$nombre_categoria/$total_imagenes.jpg')";

        if ($conn->query($sql) === TRUE) {
            echo "Producto agregado correctamente";
        } else {
            echo "Error al agregar el producto: " . $conn->error;
        }
    } else {
        echo "Error al subir la imagen.";
    }

    $conn->close();
}
?>
