<?php
// app/models/Usuario.php
class Usuario {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    /**
     * Busca un usuario por email (Necesario para tu AuthController)
     */
    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM cliente WHERE gmail = :email LIMIT 1";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Inserta un cliente (Incluyendo password y rol)
     */
    public function crear($datos) {
        $sql = "INSERT INTO cliente (nombre, fecha_i, gmail, sexo, fecha_fin, password, rol) 
                VALUES (:nombre, :fecha_i, :gmail, :sexo, :fecha_fin, :password, :rol)";

        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ":nombre"    => $datos['nombre'],
            ":gmail"     => $datos['gmail'],
            ":sexo"      => $datos['sexo'],
            ":fecha_i"   => $datos['fecha_i'],
            ":fecha_fin" => $datos['fecha_fin'],
            ":password"  => $datos['password'], // Agregado
            ":rol"       => $datos['rol']       // Agregado
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

    /**
     * Obtener datos de un cliente específico por ID
     */
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM cliente WHERE idCliente = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Actualizar datos del cliente (Incluyendo password y rol)
     */
    public function actualizar($datos) {
        $sql = "UPDATE cliente 
                SET nombre = :nombre, 
                    gmail = :gmail, 
                    sexo = :sexo, 
                    fecha_i = :fecha_i,
                    fecha_fin = :fecha_fin,
                    password = :password,
                    rol = :rol
                WHERE idCliente = :id";

        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ":nombre"    => $datos['nombre'],
            ":gmail"     => $datos['gmail'],
            ":sexo"      => $datos['sexo'],
            ":fecha_i"   => $datos['fecha_i'],
            ":fecha_fin" => $datos['fecha_fin'],
            ":password"  => $datos['password'],
            ":rol"       => $datos['rol'],
            ":id"        => $datos['id']
        ]);
    }

    /**
     * Eliminar cliente
     */
    public function eliminar($id) {
        $sql = "DELETE FROM cliente WHERE idCliente = :id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }



    // app/models/Usuario.php
public function obtenerResumenEstadistico() {
    $fechaActual = date('Y-m-d');
    $sql = "SELECT 
                sexo,
                COUNT(*) as total,
                SUM(CASE WHEN fecha_fin >= :fecha THEN 1 ELSE 0 END) as activos,
                SUM(CASE WHEN fecha_fin < :fecha OR fecha_fin IS NULL THEN 1 ELSE 0 END) as inactivos
            FROM cliente 
            GROUP BY sexo";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute([':fecha' => $fechaActual]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}