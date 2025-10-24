<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
<?php
$id = $_GET['id'];
$sql = "SELECT Consulta.*, Ciudadano.nombre FROM Consulta JOIN Ciudadano ON Consulta.id_ciudadano = Ciudadano.id WHERE Consulta.id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<h3>Consulta de <?php echo $row['nombre']; ?></h3>
<p><strong>Asunto:</strong> <?php echo $row['asunto']; ?></p>
<p><strong>Mensaje:</strong> <?php echo $row['mensaje']; ?></p>
<p><strong>Estado:</strong> <?php echo $row['estado']; ?></p>
<form method="POST" class="mt-3">
    <div class="mb-3">
        <label class="form-label">Respuesta:</label>
        <textarea class="form-control" name="respuesta"><?php echo $row['respuesta']; ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Estado:</label>
        <select class="form-select" name="estado">
            <option value="pendiente" <?php if($row['estado']=='pendiente') echo 'selected'; ?>>Pendiente</option>
            <option value="en proceso" <?php if($row['estado']=='en proceso') echo 'selected'; ?>>En proceso</option>
            <option value="resuelta" <?php if($row['estado']=='resuelta') echo 'selected'; ?>>Resuelta</option>
        </select>
    </div>
    <button class="btn btn-primary" type="submit">Actualizar</button>
    <a href="index.php" class="btn btn-secondary">Volver</a>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $respuesta = $_POST['respuesta'];
    $estado = $_POST['estado'];
    $stmt = $conn->prepare("UPDATE Consulta SET respuesta = ?, estado = ?, fecha_respuesta = NOW() WHERE id = ?");
    $stmt->bind_param("ssi", $respuesta, $estado, $id);
    $stmt->execute();
    echo "<div class='alert alert-success mt-3'>Consulta actualizada correctamente.</div>";
}
?>
</body></html>