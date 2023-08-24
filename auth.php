<?php
session_start();

$loggedin = isset($_SESSION['loggedin']) && $_SESSION['loggedin'];

error_log("Logged in status: " . ($loggedin ? "true" : "false")); // Logging the status

$response = array(
    "loggedin" => $loggedin
);

echo json_encode($response);
?>
