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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre_plan'] ?? '';
            $duracion = $_POST['duracion_meses'] ?? '';

            if (!empty($nombre) && !empty($duracion)) {
                // Se inserta el plan en gymdb
                if ($this->modelo->crear($nombre, $duracion)) {
                    
                    // Ahora $this->modeloAviso ya existe y no dará error
                    $datosAviso = [
                        'fecha' => date('Y-m-d'),
                        'descripcion' => "¡Nuevo Plan disponible!: $nombre ($duracion meses).",
                        'idCliente' => null, 
                        'idPlan' => null     
                    ];
                    
                    $this->modeloAviso->crear($datosAviso);

                    // Esta es la cadena que el JS busca para refrescar la tabla
                    echo "Éxito: Plan registrado y aviso publicado.";
                } else {
                    echo "Error: No se pudo registrar el plan.";
                }
            } else {
                echo "Error: Datos incompletos.";
            }
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