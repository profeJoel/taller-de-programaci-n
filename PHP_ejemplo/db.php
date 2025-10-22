<?php
$host = "localhost";
$user = "root";       
$pass = "q1w2e3r4.";           
$dbname = "formulario_contacto";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>

