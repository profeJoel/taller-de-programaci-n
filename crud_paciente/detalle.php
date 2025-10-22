<?php include 'db.php'; include 'header.php';
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM Paciente WHERE id_paciente = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$p = $result->fetch_assoc();
?>
<h2>Detalle del Paciente</h2>
<ul class="list-group">
  <li class="list-group-item"><strong>Nombre:</strong> <?= $p['nombre'] ?></li>
  <li class="list-group-item"><strong>RUT:</strong> <?= $p['rut'] ?></li>
  <li class="list-group-item"><strong>Teléfono:</strong> <?= $p['telefono'] ?></li>
  <li class="list-group-item"><strong>Email:</strong> <?= $p['email'] ?></li>
</ul>
<a href="index.php" class="btn btn-secondary mt-3">Volver</a>
<?php include 'footer.php'; ?>

