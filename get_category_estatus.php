<?php
// Conexión a la base de datos (reemplaza con tus propios valores)
$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "pp";


// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los datos de estatus desde la tabla TEstatus
$sql = "SELECT IdEstatus, Estatus FROM TEstatus";

// Ejecutar la consulta
$result = $conn->query($sql);

// Verificar si hay resultados y construir las opciones de estatus
$options = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $idEstatus = $row["IdEstatus"];
        $estatus = $row["Estatus"];
        $options .= "<option value='$idEstatus'>$estatus</option>";
    }
}

// Cerrar la conexión a la base de datos
$conn->close();

// Devolver las opciones de estatus
echo $options;
?>
