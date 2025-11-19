<?php
header('Content-Type: application/json');
include('conexion.php');

$fecha = $_GET['fecha'] ?? '';

$condicion = $fecha ? "WHERE A.fecha = '$fecha'" : "";

$sql = "
SELECT O.nombre AS doctor, A.fecha, T.nombre AS tratamiento
FROM Atencion A
JOIN Odontologo O ON A.id_odontologo = O.id_odontologo
JOIN Tratamiento T ON A.id_tratamiento = T.id_tratamiento
$condicion
";

$resultado = $conexion->query($sql);
$atenciones = [];

while ($fila = $resultado->fetch_assoc()) {
    $atenciones[] = $fila;
}

$agrupado_doctores = [];
$agrupado_tratamientos = [];

foreach ($atenciones as $a) {
    $agrupado_doctores[$a["doctor"]] = ($agrupado_doctores[$a["doctor"]] ?? 0) + 1;
    $agrupado_tratamientos[$a["tratamiento"]] = ($agrupado_tratamientos[$a["tratamiento"]] ?? 0) + 1;
}

$response = [
    "doctores" => [],
    "tratamientos" => []
];

foreach ($agrupado_doctores as $k => $v) {
    $response["doctores"][] = ["doctor" => $k, "cantidad" => $v];
}
foreach ($agrupado_tratamientos as $k => $v) {
    $response["tratamientos"][] = ["tratamiento" => $k, "cantidad" => $v];
}

echo json_encode($response);
$conexion->close();
?>