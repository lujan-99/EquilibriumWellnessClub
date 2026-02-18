<?php
session_start();

if ($_SESSION['rol'] != 'jefe') {
    header("Location: ../../../public/login.php");
    exit();
}
?>

<h1>Panel Jefe</h1>
<a href="../../../routes.php?action=logout">Cerrar sesión</a>
