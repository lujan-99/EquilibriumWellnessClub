<?php
require_once "app/models/Usuario.php";

class AuthController {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function login() {

        session_start();

        $email = $_POST['email'];
        $password = $_POST['password'];

        $usuarioModel = new Usuario($this->conexion);
        $usuario = $usuarioModel->buscarPorEmail($email);

        if ($usuario && $password == $usuario['password']) {

            $_SESSION['id'] = $usuario['idCliente'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['rol'] = $usuario['rol'];

            // Redirigir según rol
            if ($usuario['rol'] == "cliente") {
                header("Location: app/views/cliente/dashboard.php");
            }

            if ($usuario['rol'] == "recepcionista") {
                header("Location: app/views/admin/dashboard.php");
            }

            if ($usuario['rol'] == "jefe") {
                header("Location: app/views/admin/dashboard.php");
            }

        } else {
            echo "Credenciales incorrectas";
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: public/login.php");
    }
}
