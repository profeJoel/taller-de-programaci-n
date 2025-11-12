<?php
include 'db.php';

$query = "SELECT estado, COUNT(*) AS cantidad FROM Consulta GROUP BY estado";
$result = $conn->query($query);

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>