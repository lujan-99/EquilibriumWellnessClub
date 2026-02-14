<?php
include("conexion.php");
$nombre=$_POST['nombre_c'];
$fecha=$_POST['fecha'];
$correo=$_POST['correo_c'];
$genero=$_POST['genero_c'];
$fecha_fin='';
$sql="INSERT INTO cliente (nombre,fecha_i,gmail,sexo, fecha_fin) VALUES (?,?,?,?,?)";
$stmt=$con->prepare($sql);
$stmt->bind_param("sssss",$nombre,$fecha,$correo,$genero,$fecha_fin);
if($stmt->execute())
{
    echo "Nuevo registro insertado con éxito";
}
?>