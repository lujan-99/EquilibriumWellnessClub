<?php
// Usando la ruta absoluta para evitar el error de "No such file or directory"
require_once $_SERVER['DOCUMENT_ROOT'] . '/EquilibriumWellnessClub/config/database.php';

try {
    // Consulta para vencidos recientemente (3 días atrás) y por vencer (7 días adelante)
    $sql = "SELECT idCliente, nombre, gmail, fecha_fin, 
                   DATEDIFF(fecha_fin, CURDATE()) as dias_restantes 
            FROM cliente 
            WHERE fecha_fin BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
            ORDER BY fecha_fin ASC";

    $stmt = $conexion->prepare($sql); // Asegúrate que en conexion.php la variable se llame $conexion
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Error al conectar: " . $e->getMessage());
}

$hoy = new DateTime();
?>

<div style="background-color: #f3f5f4; padding: 15px; margin-bottom: 20px; border-left: 5px solid #d9534f;">
    <h1 style="color: #2e4356; margin: 0; font-size: 24px;">Alertas de Membresía</h1>
    <p style="color: #666;">Estado de clientes al: <strong><?php echo $hoy->format('d-m-Y'); ?></strong></p>
</div>

<table style="width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <thead>
        <tr style="background-color: #2e4356; color: white; text-align: left;">
            <th style="padding: 12px;">Cliente</th>
            <th style="padding: 12px;">Vencimiento</th>
            <th style="padding: 12px;">Días</th>
            <th style="padding: 12px;">Estado</th>
            <th style="padding: 12px;">Operación</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($resultados) > 0) : ?>
            <?php foreach ($resultados as $row) : 
                $dias = $row['dias_restantes'];
                
                if ($dias < 0) {
                    $color = "#d9534f"; $status = "VENCIDO"; $label = "Hace " . abs($dias) . " día(s)";
                } elseif ($dias == 0) {
                    $color = "#f0ad4e"; $status = "HOY"; $label = "Vence hoy";
                } else {
                    $color = "#5bc0de"; $status = "PRÓXIMO"; $label = "En $dias días";
                }
            ?>
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 12px;"><strong><?php echo $row['nombre']; ?></strong></td>
                <td style="padding: 12px;"><?php echo date("d/m/Y", strtotime($row['fecha_fin'])); ?></td>
                <td style="padding: 12px; color: <?php echo $color; ?>; font-weight: bold;"><?php echo $label; ?></td>
                <td style="padding: 12px;">
                    <span style="background: <?php echo $color; ?>; color: white; padding: 3px 8px; border-radius: 12px; font-size: 11px;">
                        <?php echo $status; ?>
                    </span>
                </td>
                <td style="padding: 12px;">
                    <button class="editarbtn" onclick="editarCliente(<?php echo $row['idCliente']; ?>)">Renovar</button>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="5" style="padding: 30px; text-align: center; color: #777;">Sin alertas críticas para esta semana.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>