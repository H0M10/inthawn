<?php
$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "AA";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$idEstatus = 1; // Valor constante para IdEstatus (ajusta este valor según lo necesites)

$carpetaCategoria = "C:/xampp/htdocs/Pagina/privado/img/" . $nombre;
if (!file_exists($carpetaCategoria)) {
    mkdir($carpetaCategoria, 0777, true);
} else {
    echo "Error: La categoría con el mismo nombre ya existe.";
    exit; // Detener la ejecución si la categoría ya existe
}

// Preparar la consulta SQL para insertar una nueva categoría
$sql = "INSERT INTO TCategorias (NombreCat, DescripcionCat, IdEstatus) VALUES ('$nombre', '$descripcion', $idEstatus)";

if ($conn->query($sql) === TRUE) {
    echo "Categoría agregada exitosamente";
    if (!file_exists($carpetaCategoria)) {
        echo " y se ha creado la carpeta para la categoría.";
    }
} else {
    echo "Error al agregar la categoría: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
