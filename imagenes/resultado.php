<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.onload = function() {
            var urlParams = new URLSearchParams(window.location.search);
            var status = urlParams.get('status');
            var message = urlParams.get('message');

            if (status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: message,
                    confirmButtonText: 'Volver al inicio',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'index.php'; // Cambia 'index.php' por la ruta que quieras redirigir.
                    }
                });
            } else if (status === 'error') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: message,
                    confirmButtonText: 'Volver al formulario'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'index.php'; // Cambia 'formulario.html' por la ruta del formulario.
                    }
                });
            }
        }
    </script>
</head>
<body>
</body>
</html>

