<?php
include("conexion.php");
$sql = "SELECT * FROM cliente";
$result = mysqli_query($con, $sql);
if (!$result) {
    die("Error en la consulta: " . mysqli_error($con));
}
?>
<h1 style="  color: #2e4356;
  background-color: #f3f5f4;
  padding: 10px;">Listado de Clientes</h1>
<button class="insertarbtn" onclick="cargarContenido('form_insert_cliente.html')">Insertar Clientes</button>
<table border="2" style="border-collapse: collapse;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Fecha de Registro</th>
            <th>Gmail</th>
            <th>Sexo</th> 
            <th>Fecha Fin</th>
            <th>Operaciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?php echo $row['idCliente']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['fecha_i']; ?></td>
                <td><?php echo $row['gmail']; ?></td>
                <td><?php echo $row['sexo']; ?></td>
                <td><?php echo $row['fecha_fin']; ?></td>
                <td style="display: flex; justify-content: space-evenly;">
                    <button class="editarbtn" onclick="editarCliente(<?php echo $row['id']; ?>)">Editar</button>
                    <button class="eliminarbtn" onclick="confirmarEliminacionCliente(<?php echo $row['id']; ?>)">Eliminar</button>
                </td>

            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
