<?php
header('Content-Type: application/json');

$host = "localhost";
$user = "root";
$pass = "q1w2e3r4.";
$db = "datos_visualizacion";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Conexion fallida: " . $conn->connect_error);
}

$sql = "SELECT categoria, SUM(valor) AS total FROM registros GROUP BY categoria";
$result = $conn->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}

echo json_encode($data);
$conn->close();
?>