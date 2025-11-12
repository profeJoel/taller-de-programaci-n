<?php
// $host = "localhost";
// $user = "root";
// $pass = "q1w2e3r4.";
// $db = "ClinicaDental";


$host = "sql10.freesqldatabase.com";
$user = "sql10806249";
$pass = "9vlKnyqvS1";
$db = "sql10806249";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
