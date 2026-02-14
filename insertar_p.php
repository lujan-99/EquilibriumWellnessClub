<?php
include("conexion.php");

$nombre = $_POST['nombre_c'];
$tipo = $_POST['tipo'];
$fecha_pago = $_POST['fecha_pago'];
$id_plan = $_POST['id_plan'];

$sql2 = "SELECT idCliente, fecha_fin FROM cliente WHERE nombre = ?";
$stmt2 = $con->prepare($sql2);
$stmt2->bind_param("s", $nombre);
$stmt2->execute();
$resultado = $stmt2->get_result();

if ($resultado->num_rows > 0) {

    $fila = $resultado->fetch_assoc();
    $id_cliente = $fila['idCliente'];
    $fecha_actual_fin = $fila['fecha_fin'];

    //  Insertar pago
    $sql = "INSERT INTO pago (tipo, fecha, idCliente, idPlan) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssii", $tipo, $fecha_pago, $id_cliente, $id_plan);
    $stmt->execute();

    //  Calcular fecha_fin
    $hoy = new DateTime();

    if ($fecha_actual_fin && new DateTime($fecha_actual_fin) > $hoy) {
        $fecha = new DateTime($fecha_actual_fin);
    } else {
        $fecha = new DateTime($fecha_pago);
    }

    switch ($id_plan) {
        case 1:
            $fecha->modify("+1 month");
            break;
        case 2:
            $fecha->modify("+3 months");
            break;
        case 3:
            $fecha->modify("+6 months");
            break;
        case 4:
            $fecha->modify("+12 months");
            break;
        default:
            die("Plan no válido");
    }

    $nueva_fecha_fin = $fecha->format("Y-m-d");

    //  Actualizar cliente
    $sqlUpdate = "UPDATE cliente SET fecha_fin = ? WHERE idCliente = ?";
    $stmtUpdate = $con->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $nueva_fecha_fin, $id_cliente);
    $stmtUpdate->execute();

    echo "Pago registrado y fecha de fin actualizada correctamente";

} else {
    echo "No se encontró el cliente con el nombre proporcionado.";
}
?>
