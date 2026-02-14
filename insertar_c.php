<?php
include("conexion.php");
$nombre=$_POST['nombre_c'];
$fecha=$_POST['fecha'];
$correo=$_POST['correo_c'];
$genero=$_POST['genero_c'];
$sql="INSERT INTO cliente (nombre,fecha,gmail,sexo) VALUES (?,?,?,?)";
$stmt=$con->prepare($sql);
$stmt->bind_param("ssss",$nombre,$fecha,$correo,$genero);
if($stmt->execute())
{
    echo "Nuevo registro insertado con éxito";
}
?>