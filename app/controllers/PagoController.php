<?php
require_once __DIR__ . "/../models/Pago.php";
require_once __DIR__ . "/../models/Usuario.php"; // Para los estudiantes
require_once __DIR__ . "/../models/Plan.php";    // Para los planes

class PagoController {
    private $modelo;
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
        $this->modelo = new Pago($conexion);
    }

    public function mostrarPagos() {
        $pagos = $this->modelo->listarTodo();
        include __DIR__ . '/../views/admin/secciones/pagos.php';
    }

    public function formularioNuevoPago() {
        // Obtenemos listas para los SELECT del formulario
        $modCliente = new Usuario($this->db);
        $modPlan = new Plan($this->db);
        
        $clientes = $modCliente->listarTodo();
        $planes = $modPlan->listarTodo();
        
        include __DIR__ . '/../views/admin/secciones/form_registrar_pago.php';
    }
    public function guardarPago() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Capturamos los datos enviados por el FormData de JS
            $tipo      = $_POST['tipo'] ?? '';
            $fecha     = $_POST['fecha'] ?? '';
            $idCliente = $_POST['idCliente'] ?? '';
            $idPlan    = $_POST['idPlan'] ?? '';

            // Validamos que los IDs no estén vacíos antes de insertar en gymdb
            if (empty($idCliente) || empty($idPlan)) {
                echo "Error: Debe seleccionar un cliente y un plan válidos.";
                return;
            }

            // Enviamos los datos al modelo Pago.php
            if ($this->modelo->crear($tipo, $fecha, $idCliente, $idPlan)) {
                echo "Éxito: Pago registrado correctamente.";
            } else {
                echo "Error: No se pudo registrar el pago en la base de datos.";
            }
        }
    }
}