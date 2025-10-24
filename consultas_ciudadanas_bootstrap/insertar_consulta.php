<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingresar Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<h2>Formulario de Consulta Ciudadana</h2>
<form method="POST" action="insertar_consulta.php" class="row g-3">
    <div class="col-md-6">
        <input class="form-control" type="text" name="nombre" placeholder="Nombre" required>
    </div>
    <div class="col-md-6">
        <input class="form-control" type="text" name="rut" placeholder="RUT" required>
    </div>
    <div class="col-md-6">
        <input class="form-control" type="email" name="email" placeholder="Correo">
    </div>
    <div class="col-md-6">
        <input class="form-control" type="text" name="telefono" placeholder="Teléfono">
    </div>
    <div class="col-12">
        <input class="form-control" type="text" name="asunto" placeholder="Asunto" required>
    </div>
    <div class="col-12">
        <textarea class="form-control" name="mensaje" placeholder="Escribe tu consulta" required></textarea>
    </div>
    <div class="col-12">
        <input class="btn btn-primary" type="submit" value="Enviar">
        <a class="btn btn-secondary" href="index.php">Volver al inicio</a>
    </div>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt1 = $conn->prepare("INSERT INTO Ciudadano (nombre, rut, email, telefono) VALUES (?, ?, ?, ?)");
    $stmt1->bind_param("ssss", $_POST['nombre'], $_POST['rut'], $_POST['email'], $_POST['telefono']);
    $stmt1->execute();
    $id_ciudadano = $stmt1->insert_id;

    $stmt2 = $conn->prepare("INSERT INTO Consulta (id_ciudadano, asunto, mensaje) VALUES (?, ?, ?)");
    $stmt2->bind_param("iss", $id_ciudadano, $_POST['asunto'], $_POST['mensaje']);
    $stmt2->execute();

    echo "<div class='alert alert-success mt-3'>Consulta enviada correctamente.</div>";
}
?>
</body></html>