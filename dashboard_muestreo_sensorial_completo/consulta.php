<?php
include 'conexion.php';
header('Content-Type: application/json');

$fecha = $_GET['fecha'] ?? '';
$comuna = $_GET['comuna'] ?? '';

$condiciones = [];
if ($fecha !== '') $condiciones[] = "M.fecha = '$fecha'";
if ($comuna !== '') $condiciones[] = "P.comuna = '$comuna'";

$where = count($condiciones) > 0 ? "WHERE " . implode(" AND ", $condiciones) : "";

$sql = "SELECT M.*, P.comuna FROM Medicion M JOIN PuntoMuestreo P ON M.id_punto = P.id_punto $where";
$res = $conexion->query($sql);

$datos = [];
while ($row = $res->fetch_assoc()) {
    $datos[] = $row;
}
echo json_encode($datos);
$conexion->close();
?>