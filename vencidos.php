<?php
include("conexion.php");

// 1. Obtener la fecha actual
$hoy = new DateTime();
$fecha_actual_formateada = $hoy->format('d-m-Y');

// 2. Consulta SQL para filtrar solo los que vencen en los próximos 7 días
// Usamos BETWEEN entre hoy y hoy + 7 días
$sql = "SELECT *, DATEDIFF(fecha_fin, CURDATE()) as dias_restantes 
        FROM cliente 
        WHERE fecha_fin BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
        ORDER BY fecha_fin ASC";

$result = mysqli_query($con, $sql);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($con));
}
?>

<div style="background-color: #f3f5f4; padding: 15px; margin-bottom: 20px; border-left: 5px solid #2e4356;">
    <h1 style="color: #2e4356; margin: 0;">Próximos Vencimientos (Esta Semana)</h1>
    <p style="color: #666;">Fecha de hoy: <strong><?php echo $fecha_actual_formateada; ?></strong></p>
</div>

<button class="insertarbtn" onclick="cargarContenido('form_insert_cliente.html')">Insertar Clientes</button>

<table border="2" style="border-collapse: collapse; width: 100%; text-align: center;">
    <thead>
        <tr style="background-color: #2e4356; color: white;">
            <th>ID</th>
            <th>Nombre</th>
            <th>Gmail</th>
            <th>Fecha Fin</th>
            <th>Días Restantes</th>
            <th>Estado</th>
            <th>Operaciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($result) > 0) : ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : 
                $dias = $row['dias_restantes'];
                // Color de advertencia según la urgencia
                $color_dias = ($dias <= 2) ? "red" : "orange";
            ?>
                <tr>
                    <td><?php echo $row['idCliente']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['gmail']; ?></td>
                    <td><?php echo date("d-m-Y", strtotime($row['fecha_fin'])); ?></td>
                    <td style="color: <?php echo $color_dias; ?>; font-weight: bold;">
                        <?php echo $dias; ?> día(s)
                    </td>
                    <td>
                        <span style="background-color: <?php echo $color_dias; ?>; color: white; padding: 2px 5px; border-radius: 5px; font-size: 12px;">
                            <?php echo ($dias == 0) ? "Vence hoy" : "Por vencer"; ?>
                        </span>
                    </td>
                    <td style="display: flex; justify-content: space-evenly; padding: 5px;">
                        <button class="editarbtn" onclick="editarCliente(<?php echo $row['idCliente']; ?>)">Editar</button>
                        <button class="eliminarbtn" onclick="confirmarEliminacionCliente(<?php echo $row['idCliente']; ?>)">Eliminar</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else : ?>
            <tr>
                <td colspan="7" style="padding: 20px;">No hay vencimientos programados para esta semana.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>