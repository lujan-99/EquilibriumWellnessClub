<?php
require_once __DIR__ . "/../models/Plan.php";

class PlanController {
    private $modelo;

    public function __construct($conexion) {
        $this->modelo = new Plan($conexion);
    }

    public function mostrarPlanes() {
        $planes = $this->modelo->listarTodo();
        include __DIR__ . '/../views/admin/secciones/planes.php';
    }

    public function guardarPlan() {
        if ($this->modelo->crear($_POST['nombre_plan'], $_POST['duracion_meses'])) {
            echo "Éxito: Plan registrado correctamente.";
        }
    }

    public function editarPlan() {
        $id = $_GET['id'];
        $plan = $this->modelo->obtenerPorId($id);
        include __DIR__ . '/../views/admin/secciones/form_editar_plan.php';
    }

    public function actualizarPlan() {
        if ($this->modelo->actualizar($_POST['idPlan'], $_POST['nombre_plan'], $_POST['duracion_meses'])) {
            echo "Éxito: Plan actualizado correctamente.";
        }
    }

    public function eliminarPlan() {
        if ($this->modelo->eliminar($_GET['id'])) {
            echo "Éxito: Plan eliminado correctamente.";
        }
    }
}