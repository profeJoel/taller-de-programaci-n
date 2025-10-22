<?php include 'db.php';
$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM Paciente WHERE id_paciente = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
header("Location: index.php");

