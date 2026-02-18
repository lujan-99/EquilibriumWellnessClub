<?php
// app/models/Cliente.php
class Cliente {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    public function listar() {
        $sql = "SELECT * FROM cliente";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }
}