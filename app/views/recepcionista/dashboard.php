<?php
session_start();

if ($_SESSION['rol'] != 'recepcionista') {
    header("Location: ../../../public/login.php");
    exit();
}
?>

<h1>Panel Recepcionista</h1>
<a href="../../../routes.php?action=logout">Cerrar sesión</a>
