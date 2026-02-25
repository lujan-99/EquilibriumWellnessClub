<?php
session_start();

// Verificamos que sea un cliente para permitir el acceso
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'cliente') {
    header("Location: ../../../public/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Cliente | Equilibrium</title>
    <link rel="stylesheet" href="../../../public/estilos.css">
    <style>
        .container-avisos { padding: 20px; max-width: 800px; margin: auto; }
        .header-cliente { display: flex; justify-content: space-between; align-items: center; background: #2e4356; color: white; padding: 15px 30px; }
        .btn-logout { background: #e74c3c; color: white; text-decoration: none; padding: 8px 15px; border-radius: 4px; }
    </style>
</head>
<body onload="cargarMisAvisos()">

    <header class="header-cliente">
        <div>
            <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?></h1>
            <small>Panel de Notificaciones</small>
        </div>
        <a href="../../../routes.php?action=logout" class="btn-logout">Cerrar Sesión</a>
    </header>

    <div class="container-avisos">
        <h2>Mis Avisos y Novedades</h2>
        <hr>
        <div id="contenido-avisos">
            <p>Cargando avisos...</p>
        </div>
    </div>

    <script>
        /**
         * Llama al controlador mediante el enrutador para obtener 
         * solo los avisos que corresponden a este cliente
         */
        function cargarMisAvisos() {
            fetch('../../../routes.php?action=misAvisos')
                .then(response => {
                    if (!response.ok) throw new Error("Error al obtener avisos");
                    return response.text();
                })
                .then(html => {
                    document.getElementById('contenido-avisos').innerHTML = html;
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('contenido-avisos').innerHTML = 
                        "<p style='color:red;'>No se pudieron cargar los avisos en este momento.</p>";
                });
        }
    </script>
</body>
</html>