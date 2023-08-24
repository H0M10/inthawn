<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "AA"; // Cambio a la nueva base de datos

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recogemos el ID de la categoría
$idCategoria = intval($_POST['idCategoria']); // Convertimos el ID a entero

// Preparamos la consulta a la base de datos
$sql = "SELECT * FROM TCategorias WHERE IdCategoria = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idCategoria); // Cambiamos 's' a 'i' ya que IdCategoria es un entero

// Ejecutamos la consulta
$stmt->execute();
$result = $stmt->get_result();

// Creamos un array para guardar la respuesta
$response = [];

if ($result->num_rows > 0) {
    // Si encontramos la categoría, la añadimos al array de respuesta
    $response = $result->fetch_assoc();
} else {
    // Si no encontramos la categoría, añadimos un mensaje de error al array de respuesta
    $response['error'] = "No se encontró ninguna categoría con ese ID.";
}

// Convertimos el array de respuesta a formato JSON y lo devolvemos
echo json_encode($response);

$stmt->close();
$conn->close();
?>
