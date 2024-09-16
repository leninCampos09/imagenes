<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #00bcd4; /* Color celeste */
            color: white;
            display: flex;
            justify-content: center; /* Centra los íconos horizontalmente */
            align-items: center;
            padding: 10px 0;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 20px;
            margin: 0 20px; /* Agrega espacio horizontal entre los íconos */
        }

        .navbar i {
            margin: 0; /* Asegúrate de que no haya márgenes adicionales */
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 60px - 40px); /* Ajusta para el footer */
        }

        h2 {
            color: #333;
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            gap: 10px;
            position: relative;
        }

        .upload-area {
            border: 2px dashed #ccc;
            border-radius: 4px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
        }

        .upload-area:hover {
            background-color: #f0f0f0;
        }

        .upload-icon {
            font-size: 40px;
            color: #333;
        }

        .file-name {
            margin-top: 10px;
            color: #555;
        }

        input[type="file"] {
            display: none;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .cancel-button {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        .cancel-button:hover {
            background-color: #c82333;
        }

        footer {
            background-color: #00bcd4; /* Color celeste */
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="navbar">
        <a id="home-icon" href="index.html"><i class="fas fa-home"></i></a>
        <a href="mostrar_imagenes.php"><i class="fas fa-images"></i></a>
    </div>
    <div class="container">
        <form action="subir_imagen.php" method="POST" enctype="multipart/form-data">
            <h2>Subir Imagen</h2>
            <div class="upload-area" id="upload-area">
                <i class="upload-icon fas fa-cloud-upload-alt"></i>
                <p>Arrastra y suelta tu archivo aquí o haz clic para seleccionar</p>
                <input type="file" name="imagen" id="imagen" accept="image/*" required>
                <div class="file-name" id="file-name">Ningún archivo seleccionado</div>
            </div>
            <input type="submit" value="Subir Imagen">
            <button type="button" id="cancel-button" class="cancel-button">Cancelar</button>
        </form>
    </div>
    <footer>
        <p>&copy; <span id="current-year"></span> Tu Empresa. Todos los derechos reservados.</p>
    </footer>

    <script>
        window.onload = function() {
            var currentPage = window.location.pathname;

            // Desactiva el enlace de "home" solo en la página específica
            if (currentPage.endsWith('index.php')) {
                document.getElementById('home-icon').addEventListener('click', function(event) {
                    event.preventDefault(); // Previene la acción del enlace
                });
            }

            // Actualiza el año en el footer
            document.getElementById('current-year').textContent = new Date().getFullYear();
            
            // Maneja el evento click del botón cancelar
            document.getElementById('cancel-button').addEventListener('click', function() {
                document.getElementById('imagen').value = ''; // Limpia el campo de archivo
                document.getElementById('file-name').textContent = 'Ningún archivo seleccionado'; // Resetea el nombre del archivo
                window.location.href = 'index.php'; // Redirige a la página principal
            });

            // Maneja el área de arrastrar y soltar
            var uploadArea = document.getElementById('upload-area');
            var fileInput = document.getElementById('imagen');
            var fileNameDisplay = document.getElementById('file-name');

            uploadArea.addEventListener('click', function() {
                fileInput.click(); // Abre el diálogo de selección de archivos al hacer clic en el área
            });

            fileInput.addEventListener('change', function() {
                var file = fileInput.files[0];
                fileNameDisplay.textContent = file ? file.name : 'Ningún archivo seleccionado'; // Muestra el nombre del archivo seleccionado
            });

            // Eventos para manejar arrastrar y soltar
            uploadArea.addEventListener('dragover', function(event) {
                event.preventDefault(); // Previene el comportamiento por defecto
                uploadArea.classList.add('drag-over');
            });

            uploadArea.addEventListener('dragleave', function(event) {
                event.preventDefault(); // Previene el comportamiento por defecto
                uploadArea.classList.remove('drag-over');
            });

            uploadArea.addEventListener('drop', function(event) {
                event.preventDefault(); // Previene el comportamiento por defecto
                uploadArea.classList.remove('drag-over');
                var files = event.dataTransfer.files;
                if (files.length > 0) {
                    fileInput.files = files; // Establece los archivos seleccionados
                    fileNameDisplay.textContent = files[0].name; // Muestra el nombre del archivo
                }
            });
        }
    </script>
</body>
</html>
