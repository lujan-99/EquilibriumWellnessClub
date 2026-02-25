<?php
// app/controllers/UsuarioController.php
require_once __DIR__ . "/../models/Usuario.php";

class UsuarioController {
    private $modelo;

    public function __construct($conexion) {
        // Inyectamos la conexión al modelo
        $this->modelo = new Usuario($conexion);
    }

    public function mostrarClientes() {
        // El controlador le pide los datos al modelo
        $clientes = $this->modelo->listarTodo();
        include __DIR__ . '/../views/admin/secciones/clientes.php';
    }

    public function guardarCliente() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                // Preparamos los datos para el modelo
                $datos = [
                    'nombre'    => $_POST['nombre'] ?? '',
                    'gmail'     => $_POST['gmail'] ?? '',
                    'sexo'      => $_POST['sexo'] ?? '',
                    'fecha_i'   => $_POST['fecha_i'] ?? '',
                    'fecha_fin' => !empty($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null
                ];

                // Validación básica
                if (empty($datos['nombre']) || empty($datos['gmail'])) {
                    echo "Error: Datos incompletos.";
                    return;
                }

                // El modelo hace el trabajo pesado
                if ($this->modelo->crear($datos)) {
                    echo "Éxito: Cliente registrado correctamente.";
                } else {
                    echo "Error: El modelo no pudo insertar el registro.";
                }
            } catch (Exception $e) {
                echo "Error en el servidor: " . $e->getMessage();
            }
        }
    }
// Dentro de la clase UsuarioController...

public function editarCliente() {
    $id = $_GET['id'] ?? null;
    $cliente = $this->modelo->obtenerPorId($id); // El modelo busca los datos
    include __DIR__ . '/../views/admin/secciones/form_editar_cliente.php';
}

public function actualizarCliente() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            // Verifica que los nombres en $_POST coincidan con los 'name' del HTML
            $datos = [
                'id'        => $_POST['idCliente'], // Este viene del input hidden
                'nombre'    => $_POST['nombre'],
                'gmail'     => $_POST['gmail'],
                'sexo'      => $_POST['sexo'],
                'fecha_i'   => $_POST['fecha_i'],
                'fecha_fin' => !empty($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null
            ];

            if ($this->modelo->actualizar($datos)) {
                echo "Éxito: Cliente actualizado correctamente.";
            } else {
                echo "Error: No se pudo actualizar en la base de datos.";
            }
        } catch (Exception $e) {
            echo "Error de SQL: " . $e->getMessage();
        }
    }
}

public function eliminarCliente() {
    $id = $_GET['id'] ?? null;
    if ($this->modelo->eliminar($id)) {
        echo "Éxito: Cliente eliminado correctamente.";
    } else {
        echo "Error al eliminar.";
    }
}

// app/controllers/UsuarioController.php
public function listarClientes() {
    $clientes = $this->modelo->listarTodo(); // Tu función actual
    $resumen = $this->modelo->obtenerResumenEstadistico();
    include __DIR__ . '/../views/admin/secciones/listar_clientes.php';
}
}