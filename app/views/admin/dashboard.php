<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: /EquilibriumWellnessClub/public/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/admin.css">

</head>


<body>

<div class="container">

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Gym System</h2>
        <p><?php echo $_SESSION['nombre']; ?> (<?php echo $_SESSION['rol']; ?>)</p>

        <ul>
            <li><a href="#" onclick="cargarSeccion('clientes')">Administrar Clientes</a></li>
            <li><a href="#" onclick="cargarSeccion('planes')">Administrar Planes</a></li>
            <li><a href="#" onclick="cargarSeccion('pagos')">Administración de Pagos</a></li>
            <li><a href="#" onclick="cargarSeccion('avisos')">Administrador de Avisos</a></li>
            <li><a class="logout" href="/EquilibriumWellnessClub/routes.php?action=logout">Cerrar sesión</a></li>
        </ul>
    </div>

    <!-- Main -->
    <div class="main">

        <h1>Bienvenido al sistema</h1>

        <div class="cards">

            <div class="card">
                <h3>Clientes</h3>
                <p>Administrar clientes registrados</p>
                <a href="#" onclick="cargarSeccion('clientes')">Ir</a>
            </div>

            <div class="card">
                <h3>Planes</h3>
                <p>Administrar planes del gimnasio</p>
                <a href="#" onclick="cargarSeccion('planes')">Ir</a>
            </div>

            <div class="card">
                <h3>Pagos</h3>
                <p>Controlar pagos y flujo de caja</p>
                <a href="#" onclick="cargarSeccion('pagos')">Ir</a>
            </div>

            <div class="card">
                <h3>Avisos</h3>
                <p>Publicar promociones y comunicados</p>
                <a href="#" onclick="cargarSeccion('avisos')">Ir</a>
            </div>

        </div>

        <div id="contenido-dinamico" style="margin-top:40px;"></div>

    </div>

</div>

<script src="/EquilibriumWellnessClub/public/js/dashboard.js"></script>
</body>
</html>
