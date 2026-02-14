<?php
include("conexion.php");
$sql = "SELECT idCliente FROM cliente";
$result = $con->query($sql);

while ($row = $result->fetch_assoc()) {
    $idCliente = $row['idCliente'];

    $sqlPago = "SELECT idPlan, fecha FROM pago 
                WHERE idCliente = ? 
                ORDER BY fecha DESC 
                LIMIT 1";

    $stmt = $con->prepare($sqlPago);
    $stmt->bind_param("i", $idCliente);
    $stmt->execute();
    $resPago = $stmt->get_result();
    $pago = $resPago->fetch_assoc();

    if ($pago) {
        $fecha = new DateTime($pago['fecha']);

        switch ($pago['idPlan']) {
            case 1: $fecha->modify("+1 month"); break;
            case 2: $fecha->modify("+3 months"); break;
            case 3: $fecha->modify("+6 months"); break;
            case 4: $fecha->modify("+12 months"); break;
        }

        $fecha_fin = $fecha->format("Y-m-d");

        $update = $con->prepare("UPDATE cliente SET fecha_fin = ? WHERE idCliente = ?");
        $update->bind_param("si", $fecha_fin, $idCliente);
        $update->execute();
    }
}
