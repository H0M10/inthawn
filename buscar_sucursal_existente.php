<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "pp";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recogemos el ID de la sucursal
$idSucursal = $_POST['idSucursal'];

// Preparamos la consulta a la base de datos
$sql = "SELECT * FROM TSucursal WHERE IdSucursal = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $idSucursal); // 's' especifica que el tipo de dato de la variable $idSucursal es una cadena (string)

// Ejecutamos la consulta
$stmt->execute();
$result = $stmt->get_result();

// Creamos un array para guardar la respuesta
$response = [];

if ($result->num_rows > 0) {
    // Si encontramos la sucursal, la añadimos al array de respuesta
    $response = $result->fetch_assoc();
} else {
    // Si no encontramos la sucursal, añadimos un mensaje de error al array de respuesta
    $response['error'] = "No se encontró ninguna sucursal con ese ID.";
}

// Convertimos el array de respuesta a formato JSON y lo devolvemos
echo json_encode($response);

$stmt->close();
$conn->close();
?>
