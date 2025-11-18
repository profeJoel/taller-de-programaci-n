<?php
header('Content-Type: application/json');

$fecha = $_GET['fecha'] ?? '';

$host = "sql10.freesqldatabase.com";
$user = "sql10806249";
$pass = "9vlKnyqvS1";
$db = "sql10806249";

$conexion = new mysqli($host, $user, $pass, $db);

//$conexion = new mysqli("localhost", "root", "", "clinica_dental");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$condicion = $fecha ? "WHERE fecha = '$fecha'" : "";

$sql = "SELECT estado, doctor, fecha FROM consulta $condicion";
$resultado = $conexion->query($sql);

$consultas = [];
while ($fila = $resultado->fetch_assoc()) {
    $consultas[] = $fila;
}

$agrupado_estado = [];
$agrupado_doctores = [];

foreach ($consultas as $c) {
    $agrupado_estado[$c["estado"]] = ($agrupado_estado[$c["estado"]] ?? 0) + 1;
    $agrupado_doctores[$c["doctor"]] = ($agrupado_doctores[$c["doctor"]] ?? 0) + 1;
}

$response = [
    "estado" => [],
    "doctores" => []
];

foreach ($agrupado_estado as $k => $v) {
    $response["estado"][] = ["estado" => $k, "cantidad" => $v];
}

foreach ($agrupado_doctores as $k => $v) {
    $response["doctores"][] = ["doctor" => $k, "cantidad" => $v];
}

echo json_encode($response);
$conexion->close();
?>