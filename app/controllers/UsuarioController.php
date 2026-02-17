<?php
require_once "app/models/Usuario.php";

class UsuarioController {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function listar() {
        $model = new Usuario($this->conexion);
        echo json_encode($model->listar());
    }

    public function crear() {
        $model = new Usuario($this->conexion);

        $model->crear(
            $_POST['nombre'],
            $_POST['gmail'],
            $_POST['password'],
            $_POST['rol']
        );

        echo "ok";
    }

    public function eliminar() {
        $model = new Usuario($this->conexion);
        $model->eliminar($_POST['id']);
        echo "ok";
    }
}
