<?php
include("conexion.php");

$id = $_GET['id'];

$sql = "DELETE FROM cliente WHERE idCliente = '$id'";
$result = mysqli_query($con, $sql);

if($result){
    echo "<script>
            alert('Cliente eliminado correctamente');
            cargarContenido('listar_cliente.php');
          </script>";
} else {
    echo "Error al eliminar: " . mysqli_error($con);
}
?>
