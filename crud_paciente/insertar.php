<?php include 'db.php'; include 'header.php';
if ($_POST) {
    $stmt = $conn->prepare("INSERT INTO Paciente (nombre, rut, telefono, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $_POST['nombre'], $_POST['rut'], $_POST['telefono'], $_POST['email']);
    $stmt->execute();
    header("Location: index.php");
}
?>
<h2>Nuevo Paciente</h2>
<form method="post">
  <div class="mb-3">
    <label>Nombre</label>
    <input type="text" name="nombre" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>RUT</label>
    <input type="text" name="rut" class="form-control">
  </div>
  <div class="mb-3">
    <label>Teléfono</label>
    <input type="text" name="telefono" class="form-control">
  </div>
  <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control">
  </div>
  <button class="btn btn-primary">Guardar</button>
</form>
<?php include 'footer.php'; ?>

