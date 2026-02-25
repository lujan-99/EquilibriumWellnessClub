<div class="tabla-contenedor">
    <table border="1" style="width:100%; border-collapse: collapse; background: white;">
        <thead style="background:#2e4356; color:white;">
            <tr>
                <th style="padding:12px;">Fecha</th>
                <th style="padding:12px;">Comunicado</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($avisos)): ?>
                <?php foreach ($avisos as $a): ?>
                    <tr>
                        <td style="padding:10px; text-align:center;"><?php echo $a['fecha']; ?></td>
                        <td style="padding:10px;"><?php echo htmlspecialchars($a['descripcion']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2" style="text-align:center; padding:20px;">No hay avisos registrados en el sistema.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>