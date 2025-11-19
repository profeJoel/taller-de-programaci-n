<?php

$host = 'localhost';
$db = 'ClinicaDental';
$user = 'root';
$pass = 'q1w2e3r4.';

$conexion = new mysqli($host, $user, $pass, $db);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>