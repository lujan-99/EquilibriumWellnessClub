<?php
include("conexion.php");
$sql="SELECT * FROM pago";
$result=mysqli_query($con,$sql);
if(!$result){
    die("Error en la consulta: ".mysqli_error($con));
}
?>
<h1 style="  color: #2e4356;
  background-color: #f3f5f4;
  padding: 10px;">Listado de Pagos</h1>
<table border="2" style="border-collapse: collapse;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Fecha de Pago</th>
            <th>ID Cliente</th>
            <th>ID Plan</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row=mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?php echo $row['idPagos']; ?></td>
                <td><?php echo $row['tipo']; ?></td>
                <td><?php echo $row['fecha']; ?></td>
                <td><?php echo $row['idCliente']; ?></td>
                <td><?php echo $row['idPlan']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>