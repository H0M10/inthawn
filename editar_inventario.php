
<?php
$servername = "localhost";
$username = "root";
$password = "hanniel";
$dbname = "pp";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idInventario = $_POST["idInventario"];
    $idProducto = $_POST["idProducto"];
    $nombreProd = $_POST["nombreProd"];
    $idCategoria = $_POST["idCategoria"];
    $precioUnitarioProd = $_POST["precioUnitarioProd"];
    $cantidadInv = $_POST["cantidadInv"];
    $idEstatus = $_POST["idEstatus"];
    $idSucursal = $_POST["idSucursal"];

    $sql = "UPDATE TInventario SET
                IdProducto = '$idProducto',
                NombreProd = '$nombreProd',
                IdCategoria = '$idCategoria',
                PrecioUnitarioProd = '$precioUnitarioProd',
                CantidadInv = '$cantidadInv',
                IdEstatus = '$idEstatus',
                IdSucursal = '$idSucursal'
            WHERE IdInventario = '$idInventario'";

    if ($conn->query($sql) === TRUE) {
        echo "Inventario actualizado correctamente";
    } else {
        echo "Error al actualizar el inventario: " . $conn->error;
    }
}

$conn->close();
?>