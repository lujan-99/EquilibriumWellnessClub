<?php

require_once "config/database.php";
require_once "app/controllers/AuthController.php";
require_once "app/controllers/UsuarioController.php";


$action = $_POST['action'] ?? $_GET['action'] ?? null;

if ($action == "login") {
    $controller = new AuthController($conexion);
    $controller->login();
}

if ($action == "logout") {
    $controller = new AuthController($conexion);
    $controller->logout();
}
if ($action == "listarUsuarios") {
    $controller = new UsuarioController($conexion);
    $controller->listar();
}

if ($action == "crearUsuario") {
    $controller = new UsuarioController($conexion);
    $controller->crear();
}

if ($action == "eliminarUsuario") {
    $controller = new UsuarioController($conexion);
    $controller->eliminar();
}
