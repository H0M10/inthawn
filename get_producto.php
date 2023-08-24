<?php
// Conexión a la base de datos (reemplaza los valores con los de tu base de datos)
$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "pp";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['idProducto'])) {
    $idProducto = $_POST['idProducto'];

    // Consulta el registro del producto en la base de datos
    $sql = "SELECT * FROM TProductos WHERE IdProducto = '$idProducto'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obtener el primer registro (debería haber solo uno ya que se busca por ID único)
        $row = $result->fetch_assoc();

        // Crear un array con la información del producto
        $producto = array(
            'IdProducto' => $row['IdProducto'],
            'NombreProd' => $row['NombreProd'],
            'DescripcionProd' => $row['DescripcionProd'],
            'IdCategoria' => $row['IdCategoria'],
            'IdEmpleado' => $row['IdEmpleado'],
            'IdSucursal' => $row['IdSucursal'],
            'IdEstatus' => $row['IdEstatus'],
            'PrecioUnitario' => $row['PrecioUnitario'],
            'Cantidad' => $row['Cantidad']
        );

        // Devolver la información del producto como respuesta JSON
        header('Content-Type: application/json');
        echo json_encode($producto);
    } else {
        // Si no se encuentra el producto, devolver un mensaje de error
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Producto no encontrado'));
    }
} else {
    // Si no se proporciona el ID del producto, devolver un mensaje de error
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'No se proporcionó el ID del producto'));
}

$conn->close();
?>
