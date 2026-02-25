<?php
class Aviso {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function listarTodo() {
        // Traemos los avisos con el nombre del cliente y del plan si están asignados
        $sql = "SELECT a.*, c.nombre as cliente_nom, p.nombre_plan as plan_nom 
                FROM avisos a
                LEFT JOIN cliente c ON a.idCliente = c.idCliente
                LEFT JOIN plan p ON a.idPlan = p.idPlan
                ORDER BY a.fecha DESC";
        return $this->conexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

public function crear($datos) {
    $sql = "INSERT INTO avisos (fecha, descripcion, idCliente, idPlan) 
            VALUES (:fecha, :descripcion, :idCliente, :idPlan)";
    $stmt = $this->conexion->prepare($sql);
    return $stmt->execute([
        ':fecha'       => $datos['fecha'],
        ':descripcion' => $datos['descripcion'],
        ':idCliente'   => !empty($datos['idCliente']) ? $datos['idCliente'] : null,
        ':idPlan'      => !empty($datos['idPlan']) ? $datos['idPlan'] : null
    ]);
}

    public function eliminar($id) {
        $sql = "DELETE FROM avisos WHERE idAviso = :id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

// app/models/Aviso.php
public function listarParaCliente($idCliente) {
    // Obtenemos primero el plan del cliente para filtrar avisos por plan también
    $sqlPlan = "SELECT idPlan FROM cliente WHERE idCliente = :id";
    $stmtPlan = $this->conexion->prepare($sqlPlan);
    $stmtPlan->execute([':id' => $idCliente]);
    $res = $stmtPlan->fetch(PDO::FETCH_ASSOC);
    $idPlan = $res['idPlan'] ?? 0;

    // Consulta triple: avisos personales, avisos de su plan o avisos generales (NULL)
    $sql = "SELECT * FROM avisos 
            WHERE idCliente = :idCliente 
            OR idPlan = :idPlan 
            OR (idCliente IS NULL AND idPlan IS NULL)
            ORDER BY fecha DESC";
            
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute([
        ':idCliente' => $idCliente,
        ':idPlan'    => $idPlan
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    }