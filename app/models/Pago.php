<?php
class Pago {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function listarTodo() {
        // Unimos las tablas para mostrar nombres en lugar de IDs
        $sql = "SELECT p.idPagos, p.tipo, p.fecha, c.nombre AS cliente_nombre, pl.nombre_plan AS plan_nombre 
                FROM pago p
                JOIN cliente c ON p.idCliente = c.idCliente
                JOIN plan pl ON p.idPlan = pl.idPlan
                ORDER BY p.fecha DESC";
        return $this->conexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($tipo, $fecha, $idCliente, $idPlan) {
        $sql = "INSERT INTO pago (tipo, fecha, idCliente, idPlan) VALUES (:tipo, :fecha, :idCliente, :idPlan)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':tipo' => $tipo,
            ':fecha' => $fecha,
            ':idCliente' => $idCliente,
            ':idPlan' => $idPlan
        ]);
    }
}