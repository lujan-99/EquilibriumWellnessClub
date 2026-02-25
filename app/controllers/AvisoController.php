<?php
require_once __DIR__ . "/../models/Aviso.php";
require_once __DIR__ . "/../models/Usuario.php"; 
require_once __DIR__ . "/../models/Plan.php";    

class AvisoController {
    private $modelo;
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
        $this->modelo = new Aviso($conexion);
    }

    public function mostrarAvisos() {
        $avisos = $this->modelo->listarTodo();
        include __DIR__ . '/../views/admin/secciones/avisos.php';
    }

    public function formularioNuevoAviso() {
        $modCliente = new Usuario($this->conexion);
        $modPlan = new Plan($this->conexion);
        $clientes = $modCliente->listarTodo();
        $planes = $modPlan->listarTodo();
        include __DIR__ . '/../views/admin/secciones/form_registrar_aviso.php';
    }

    public function guardarAviso() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->modelo->crear($_POST)) {
                echo "Éxito: Aviso publicado.";
            } else {
                echo "Error al publicar aviso.";
            }
        }
    }
    // app/controllers/AvisoController.php

public function eliminar() {
    $id = $_GET['id'] ?? null;
    if ($id) {
        if ($this->modelo->eliminar($id)) {
            echo "Éxito: Aviso eliminado correctamente.";
        } else {
            echo "Error: No se pudo eliminar el aviso.";
        }
    }
}
// app/controllers/AvisoController.php
// app/controllers/AvisoController.php

public function mostrarAvisosCliente() {
    // Pedimos todos los avisos sin filtrar por ID
    $avisos = $this->modelo->listarTodo(); 
    
    // Cargamos la vista de la tabla
    $vistaPath = __DIR__ . '/../views/cliente/secciones/mis_avisos.php';
    
    if (file_exists($vistaPath)) {
        include $vistaPath;
    } else {
        echo "Error: No se encuentra el archivo de vista en: " . $vistaPath;
    }
}
}