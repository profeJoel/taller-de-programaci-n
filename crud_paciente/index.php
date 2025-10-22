<?php include 'db.php'; include 'header.php';
$result = $conn->query("SELECT * FROM Paciente ORDER BY id_paciente DESC");
?>
<h2>Lista de Pacientes</h2>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>RUT</th>
      <th>Teléfono</th>
      <th>Email</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
<?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['nombre'] ?></td>
      <td><?= $row['rut'] ?></td>
      <td><?= $row['telefono'] ?></td>
      <td><?= $row['email'] ?></td>
      <td>
        <a href="detalle.php?id=<?= $row['id_paciente'] ?>" class="btn btn-info btn-sm">Ver</a>
        <a href="editar.php?id=<?= $row['id_paciente'] ?>" class="btn btn-warning btn-sm">Editar</a>
        <a href="eliminar.php?id=<?= $row['id_paciente'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro de eliminar?')">Eliminar</a>
      </td>
    </tr>
<?php endwhile; ?>
  </tbody>
</table>
<?php include 'footer.php'; ?>
