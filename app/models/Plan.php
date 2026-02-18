<?php
class Plan {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function listarTodo() {
        $sql = "SELECT * FROM plan";
        return $this->conexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($nombre, $duracion) {
        $sql = "INSERT INTO plan (nombre_plan, duracion_meses) VALUES (:nombre, :duracion)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([':nombre' => $nombre, ':duracion' => $duracion]);
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM plan WHERE idPlan = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $nombre, $duracion) {
        $sql = "UPDATE plan SET nombre_plan = :nombre, duracion_meses = :duracion WHERE idPlan = :id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([':nombre' => $nombre, ':duracion' => $duracion, ':id' => $id]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM plan WHERE idPlan = :id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}