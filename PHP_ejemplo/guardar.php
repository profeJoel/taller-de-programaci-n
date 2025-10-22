<?php
include 'db.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitizar los datos recibidos
    $nombre = htmlspecialchars($_POST["nombre"]);
    $email = htmlspecialchars($_POST["email"]);
    $mensaje = htmlspecialchars($_POST["mensaje"]);

    // Preparar la consulta para evitar inyección SQL
    $stmt = $conn->prepare("INSERT INTO mensajes (nombre, email, mensaje) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $mensaje);

    if ($stmt->execute()) {
        echo "<h1>Gracias por tu mensaje</h1>";
        echo "<p><strong>Nombre:</strong> $nombre</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Mensaje:</strong> $mensaje</p>";
        echo "<p><em>Tu mensaje ha sido guardado correctamente en la base de datos.</em></p>";
    } else {
        echo "<p>Error al guardar el mensaje: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<p>Error: Debes enviar el formulario correctamente.</p>";
}
?>

