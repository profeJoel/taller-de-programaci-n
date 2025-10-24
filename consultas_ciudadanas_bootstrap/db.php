<?php
$host = 'localhost';
$db = 'consultas_ciudadanas';
$user = 'root';
$pass = 'q1w2e3r4.';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Conexión fallida: ' . $conn->connect_error);
}
?>