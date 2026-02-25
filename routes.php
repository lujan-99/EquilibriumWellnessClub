<?php

require_once "config/database.php";
require_once "app/controllers/AuthController.php";
require_once "app/controllers/UsuarioController.php";


$action = $_POST['action'] ?? $_GET['action'] ?? null;
// ... dentro de routes.php ...



if ($action == "login") {
    $controller = new AuthController($conexion);
    $controller->login();
}

if ($action == "logout") {
    $controller = new AuthController($conexion);
    $controller->logout();
}
// if ($action == "listarUsuarios") {
//     $controller = new UsuarioController($conexion);
//     $controller->listar();
// }

if ($action == "crearUsuario") {
    $controller = new UsuarioController($conexion);
    $controller->crear();
}

if ($action == "eliminarUsuario") {
    $controller = new UsuarioController($conexion);
    $controller->eliminar();
}


if ($action == 'listarClientes') {
    $controller = new UsuarioController($conexion);
    $controller->mostrarClientes();
}



if ($action === 'guardarCliente') {
    $controller = new UsuarioController($conexion);
    $controller->guardarCliente();
}

if ($action === 'editarCliente') {
    $controller = new UsuarioController($conexion);
    $controller->editarCliente();
} 
if ($action === 'actualizarCliente') {
    $controller = new UsuarioController($conexion); 
    $controller->actualizarCliente();
} 
if ($action === 'eliminarCliente') {
    $controller = new UsuarioController($conexion);
    $controller->eliminarCliente();
}



require_once "app/controllers/PlanController.php";
$planCtrl = new PlanController($conexion);

if ($action === 'listarPlanes') { $planCtrl->mostrarPlanes(); }
if ($action === 'guardarPlan') { $planCtrl->guardarPlan(); }
if ($action === 'editarPlan') { $planCtrl->editarPlan(); }
if ($action === 'actualizarPlan') { $planCtrl->actualizarPlan(); }
if ($action === 'eliminarPlan') { $planCtrl->eliminarPlan(); }


// routes.php
require_once "app/controllers/PagoController.php";
$pagoCtrl = new PagoController($conexion);

if ($action === 'listarPagos') {
    $pagoCtrl->mostrarPagos();
} elseif ($action === 'nuevoPago') {
    $pagoCtrl->formularioNuevoPago();
} elseif ($action === 'guardarPago') {
    $pagoCtrl->guardarPago();
}


// routes.php
require_once "app/controllers/AvisoController.php";
$avisoCtrl = new AvisoController($conexion);

if ($action === 'listarAvisos') {
    $avisoCtrl->mostrarAvisos();
} elseif ($action === 'nuevoAviso') {
    $avisoCtrl->formularioNuevoAviso();
} elseif ($action === 'guardarAviso') {
    $avisoCtrl->guardarAviso();
}

// routes.php
if ($action === 'eliminarAviso') {
    $avisoCtrl->eliminar(); // Asegúrate de que este método exista en el controlador
}


// routes.php
// ... después de las instanciaciones ...
$avisoCtrl = new AvisoController($conexion);

// routes.php

if ($action === 'misAvisos') {
    $avisoCtrl->mostrarAvisosCliente();
}