<?php
// app/models/Usuario.php
class Usuario {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    /**
     * Inserta un cliente en la base de datos
     */
    public function crear($datos) {
        $sql = "INSERT INTO cliente (nombre, fecha_i, gmail, sexo, fecha_fin) 
                VALUES (:nombre, :fecha_i, :gmail, :sexo, :fecha_fin)";

        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ":nombre"    => $datos['nombre'],
            ":gmail"     => $datos['gmail'],
            ":sexo"      => $datos['sexo'],
            ":fecha_i"   => $datos['fecha_i'],
            ":fecha_fin" => $datos['fecha_fin']
        ]);
    }

    /**
     * Obtiene todos los clientes
     */
    public function listarTodo() {
        $sql = "SELECT * FROM cliente";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener datos de un cliente específico por ID
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM cliente WHERE idCliente = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar datos del cliente
public function actualizar($datos) {
    // Es vital que el WHERE use 'idCliente' que es tu llave primaria
    $sql = "UPDATE cliente 
            SET nombre = :nombre, 
                gmail = :gmail, 
                sexo = :sexo, 
                fecha_i = :fecha_i,
                fecha_fin = :fecha_fin
            WHERE idCliente = :id";

    $stmt = $this->conexion->prepare($sql);
    return $stmt->execute([
        ":nombre"    => $datos['nombre'],
        ":gmail"     => $datos['gmail'],
        ":sexo"      => $datos['sexo'],
        ":fecha_i"   => $datos['fecha_i'],
        ":fecha_fin" => $datos['fecha_fin'],
        ":id"        => $datos['id']
    ]);
}
    // Eliminar cliente
    public function eliminar($id) {
        $sql = "DELETE FROM cliente WHERE idCliente = :id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}