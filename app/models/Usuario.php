<?php

class Usuario {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function buscarPorEmail($email) {

        $sql = "SELECT * FROM cliente WHERE gmail = :email";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listar() {
    $sql = "SELECT idCliente, nombre, gmail, rol FROM cliente";
    return $this->conexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

public function crear($nombre, $gmail, $password, $rol) {
    $sql = "INSERT INTO cliente (nombre, gmail, password, rol, fecha_i) 
            VALUES (:nombre, :gmail, :password, :rol, CURDATE())";

    $stmt = $this->conexion->prepare($sql);
    $stmt->execute([
        ":nombre" => $nombre,
        ":gmail" => $gmail,
        ":password" => $password,
        ":rol" => $rol
    ]);
}

public function eliminar($id) {
    $sql = "DELETE FROM cliente WHERE idCliente = :id";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute([":id" => $id]);
}

}
