<?php include 'db.php'; include 'header.php';
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM Paciente WHERE id_paciente = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$p = $result->fetch_assoc();
if ($_POST) {
    $stmt = $conn->prepare("UPDATE Paciente SET nombre=?, rut=?, telefono=?, email=? WHERE id_paciente=?");
    $stmt->bind_param("ssssi", $_POST['nombre'], $_POST['rut'], $_POST['telefono'], $_POST['email'], $id);
    $stmt->execute();
    header("Location: index.php");
}
?>
<h2>Editar Paciente</h2>
<form method="post">
  <div class="mb-3">
    <label>Nombre</label>
    <input type="text" name="nombre" class="form-control" value="<?= $p['nombre'] ?>" required>
  </div>
  <div class="mb-3">
    <label>RUT</label>
    <input type="text" name="rut" class="form-control" value="<?= $p['rut'] ?>">
  </div>
  <div class="mb-3">
    <label>Teléfono</label>
    <input type="text" name="telefono" class="form-control" value="<?= $p['telefono'] ?>">
  </div>
  <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="<?= $p['email'] ?>">
  </div>
  <button class="btn btn-primary">Actualizar</button>
</form>
<?php include 'footer.php'; ?>

