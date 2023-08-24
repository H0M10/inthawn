<?php
session_start();

$response = array();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['tipoUsu']) && $_SESSION['tipoUsu'] === 1) {
    $response['loggedin'] = true;
} else {
    $response['loggedin'] = false;
}

header('Content-Type: application/json');
echo json_encode($response);
?>
