<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_imagenes";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $directorio_subida = 'uploads/';
    
    // Verifica si el directorio de uploads existe, si no, lo crea
    if (!is_dir($directorio_subida)) {
        mkdir($directorio_subida, 0777, true);
    }

    // Obtener nombre y contenido del archivo
    $nombre_original = basename($_FILES["imagen"]["name"]);
    $contenido_imagen = file_get_contents($_FILES["imagen"]["tmp_name"]);
    
    // Generar un hash usando md5 del contenido de la imagen
    $hash_imagen = md5($contenido_imagen);
    
    // Obtener la extensión del archivo original
    $extension = strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION));
    
    // Crear el nombre del archivo usando el hash
    $nombre_imagen = $hash_imagen . '.' . $extension;
    $ruta_imagen = $directorio_subida . $nombre_imagen;

    // Verificar si es una imagen
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if ($check !== false) {
        // Verificar si la imagen ya existe
        if (file_exists($ruta_imagen)) {
            header("Location: resultado.php?status=error&message=Lo%20siento,%20esta%20imagen%20ya%20existe.");
            exit();
        } else {
            // Subir la imagen
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_imagen)) {
                // Insertar información en la base de datos
                $sql = "INSERT INTO imagenes (nombre_imagen, ruta_imagen) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $nombre_imagen, $ruta_imagen);

                if ($stmt->execute()) {
                    header("Location: resultado.php?status=success&message=La%20imagen%20ha%20sido%20subida%20exitosamente.");
                } else {
                    header("Location: resultado.php?status=error&message=Error%20al%20subir%20la%20imagen.");
                }
            } else {
                header("Location: resultado.php?status=error&message=Hubo%20un%20error%20al%20subir%20la%20imagen.");
            }
        }
    } else {
        header("Location: resultado.php?status=error&message=El%20archivo%20no%20es%20una%20imagen.");
    }

    $stmt->close();
}

$conn->close();
?>
