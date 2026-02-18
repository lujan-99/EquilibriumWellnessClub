<?php
session_start();

// Si NO hay sesión iniciada
if (!isset($_SESSION['rol'])) {
    header("Location: login.php");
    exit();
}

// Si ya hay sesión, redirigir según rol
if ($_SESSION['rol'] == "cliente") {
    header("Location: ../app/views/cliente/dashboard.php");
    exit();
}

if ($_SESSION['rol'] == "recepcionista") {
    header("Location: ../app/views/recepcionista/dashboard.php");
    exit();
}

if ($_SESSION['rol'] == "jefe") {
    header("Location: ../app/views/jefe/dashboard.php");
    exit();
}
