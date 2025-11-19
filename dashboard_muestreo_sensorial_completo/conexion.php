<?php
$conexion = new mysqli("localhost", "root", "q1w2e3r4.", "MonitoreoFluvial");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>