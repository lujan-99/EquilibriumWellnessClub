<?php
session_start();

if ($_SESSION['rol'] != 'cliente') {
    header("Location: ../../../public/login.php");
    exit();
}
?>

<h1>Bienvenido Cliente</h1>
<p><?php echo $_SESSION['nombre']; ?></p>
<a href="../../../routes.php?action=logout">Cerrar sesión</a>
