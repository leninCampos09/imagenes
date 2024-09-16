<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_imagenes";

// Verificar que se ha pasado un ID de imagen
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de imagen no válido.");
}

$id_imagen = intval($_GET['id']);

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar y ejecutar la consulta de eliminación
$sql = "DELETE FROM imagenes WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param("i", $id_imagen);

if ($stmt->execute()) {
    // Redirigir de vuelta a la página de imágenes con un mensaje de éxito
    header("Location: mostrar_imagenes.php?msg=Imagen eliminada con éxito");
} else {
    // Redirigir con un mensaje de error
    header("Location: mostrar_imagenes.php?msg=Error al eliminar la imagen");
}

$stmt->close();
$conn->close();
?>
