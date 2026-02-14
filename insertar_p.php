<?php
include("conexion.php");
$nombre=$_POST['nombre_c'];
$tipo=$_POST['tipo'];
$fecha=$_POST['fecha_pago'];
$id_plan=$_POST['id_plan'];
$sql2="SELECT idCliente FROM cliente WHERE nombre='$nombre'";
$resultado=$con->query($sql2);
if ($resultado && $resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $id_cliente = $fila['idCliente'];
    $sql="INSERT INTO pago (tipo,fecha,idCliente,idPlan) VALUES (?,?,?,?)";
    $stmt=$con->prepare($sql);
    $stmt->bind_param("ssii",$tipo,$fecha,$id_cliente,$id_plan);
    if($stmt->execute())
    {
    echo "Nuevo registro insertado con éxito";
}
} else {
    echo "No se encontró el cliente con el nombre proporcionado.";
}
?>