<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Imágenes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #00bfff; /* Celeste */
            color: white;
            display: flex;
            justify-content: center; /* Centra los íconos */
            align-items: center;
            padding: 10px 0;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 20px;
            margin: 0 15px; /* Espacio entre los íconos */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: white;
        }

        img {
            max-width: 150px;
            height: auto;
            border-radius: 8px;
        }

        caption {
            font-size: 24px;
            margin: 10px 0;
        }

        .btn-eliminar {
            display: inline-block;
            padding: 8px 16px;
            color: #fff;
            background-color: #e74c3c; /* Rojo */
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-eliminar:hover {
            background-color: #c0392b; /* Rojo más oscuro */
            color: #f9f9f9;
        }

        .btn-eliminar:active {
            background-color: #a93226; /* Rojo aún más oscuro */
        }

        footer {
            background-color: #00bfff; /* Celeste */
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="navbar">
        <a href="index.php"><i class="fas fa-home"></i></a>
        <a href="mostrar_imagenes.php"><i class="fas fa-images"></i></a>
    </div>
    <table>
        <caption>Galería de Imágenes</caption>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "sistema_imagenes";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            $sql = "SELECT id, nombre_imagen, ruta_imagen FROM imagenes ORDER BY fecha_subida DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><img src='" . $row["ruta_imagen"] . "' alt='" . $row["nombre_imagen"] . "'></td>";
                    echo "<td>" . $row["nombre_imagen"] . "</td>";
                    echo "<td><a href='#' class='btn-eliminar' onclick='confirmarEliminacion(" . $row["id"] . ")'>Eliminar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No hay imágenes subidas.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <script>
        function confirmarEliminacion(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Estás seguro de que deseas eliminar esta imagen?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirigir al script PHP para eliminar la imagen
                    window.location.href = 'eliminar_imagen.php?id=' + id;
                }
            });
        }

        // Establecer el año actual en el footer
        document.addEventListener('DOMContentLoaded', (event) => {
            const yearSpan = document.getElementById('current-year');
            if (yearSpan) {
                yearSpan.textContent = new Date().getFullYear();
            }
        });
    </script>
    <footer>
        <p>&copy; <span id="current-year"></span> Tu Empresa. Todos los derechos reservados.</p>
    </footer>
</body>
</html>


