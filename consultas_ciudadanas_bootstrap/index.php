<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultas Registradas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
<h2 class="mb-4">Consultas Ciudadanas</h2>
<a href="insertar_consulta.php" class="btn btn-success mb-3">Nueva Consulta</a>
<table class="table table-striped">
<thead><tr><th>ID</th><th>Nombre</th><th>Asunto</th><th>Estado</th><th>Acciones</th></tr></thead>
<tbody>
<?php
$sql = "SELECT Consulta.id, nombre, asunto, estado FROM Consulta JOIN Ciudadano ON Consulta.id_ciudadano = Ciudadano.id ORDER BY Consulta.id DESC";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['nombre']}</td>
        <td>{$row['asunto']}</td>
        <td>{$row['estado']}</td>
        <td>
            <a class='btn btn-info btn-sm' href='ver_consulta.php?id={$row['id']}'>Ver</a>
            <a class='btn btn-danger btn-sm' href='eliminar_consulta.php?id={$row['id']}'>Eliminar</a>
        </td>
    </tr>";
}
?>
</tbody>
</table>
</body></html>