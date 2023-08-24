<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "No has iniciado sesión. Redirigiendo...";
    header("Location: login.php");
    exit;
} elseif (isset($_SESSION['user']['IdTipo']) && ($_SESSION['user']['IdTipo'] == "3")) {
    // Si el usuario es de tipo 3, redirigir a otra página o mostrar un mensaje de error.
    echo "No tienes permiso para acceder a esta página.";
    header("Location: pagina_error.php"); // Puedes redirigir a cualquier página que desees.
    exit;
} else {
    echo "Has iniciado sesión."; 
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script defer src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="script1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <div class="card">
        <div class="card-header">Filtro</div>
        <div class="card-body">
            <form action="" method="post">
                Fecha inicial:
                <input type="date" name="inicio" id="inicio">
                Fecha final:
                <input type="date" name="fin" id="fin">
                <input class="btn btn-primary btn-space" type="submit" value="Filtrar">
                &nbsp;|&nbsp;&nbsp;<a class="btn btn-warning btn-space" href="reporte_productos.php">Mostrar todos</a>
            </form>
        </div>
    </div>
    <br>
    <table id="tabla" class="display" style="width:100%">
        <thead>
            <tr>
                <th>No. Venta</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Total </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $whereConsulta = "";
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST["inicio"]) && isset($_POST["fin"])) {
                    $whereConsulta = " WHERE v.fechaventa BETWEEN '" . $_POST["inicio"] . "' AND '" . $_POST["fin"] . "'";
                }
            }

            $servername = "localhost";
            $username = "root";
            $password = "hanniel";
            $dbname = "AA";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT v.IdVenta AS idventa, v.FechaVenta AS fechaventa, u.NombreUsu AS nombrecliente, SUM(dv.Cantidad) AS totalProductos
                    FROM TVentas v 
                    JOIN TUsuario u ON u.IdUsuario = v.IdUsuario
                    JOIN TDetallesVenta dv ON dv.IdVenta = v.IdVenta" . $whereConsulta . 
                    " GROUP BY v.IdVenta, v.FechaVenta, u.NombreUsu";

            $result = $conn->query($sql);
            $totalProductosGlobal = 0;

            while ($row = $result->fetch_assoc()) {
                $totalProductosGlobal += $row["totalProductos"];
                echo '<tr>
                        <td>' . $row["idventa"] . '</td>
                        <td>' . $row["fechaventa"] . '</td>
                        <td>' . $row["nombrecliente"] . '</td>
                        <td>' . $row["totalProductos"] . '</td>
                      </tr>';
            }
            
            

            $conn->close();
            ?>
        </tbody>
        
    </table>
    <div class="totalProductos">
    <input type="hidden" id="totalProductosHidden" value="<?php echo $totalProductosGlobal; ?>">

    <strong>Total de Productos Vendidos:</strong> <?php echo $totalProductosGlobal; ?>
</div>
    <script>
        $(document).ready(function() {
            $('#tabla').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
</body>

</html>
