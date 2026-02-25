<h1 style="color: #2e4356; background-color: #f3f5f4; padding: 10px;">Historial de Pagos</h1>

<div style="display: flex; gap: 15px; margin-bottom: 20px;">
    <?php
    $mes_actual = date('m');
    $mes_pasado = date('m', strtotime("-1 month"));
    $anio_actual = date('Y');

    // Inicializamos contadores para los planes conocidos
    $stats = [
        'Mensual' => ['actual' => 0, 'pasado' => 0],
        'Trimestral' => ['actual' => 0, 'pasado' => 0],
        'Semestral' => ['actual' => 0, 'pasado' => 0],
        'Anual' => ['actual' => 0, 'pasado' => 0]
    ];

    foreach ($pagos as $p) {
        $mes_pago = date('m', strtotime($p['fecha']));
        $anio_pago = date('Y', strtotime($p['fecha']));
        $nombre_p = $p['plan_nombre'];

        if (isset($stats[$nombre_p])) {
            if ($anio_pago == $anio_actual) {
                if ($mes_pago == $mes_actual) {
                    $stats[$nombre_p]['actual']++;
                } elseif ($mes_pago == $mes_pasado) {
                    $stats[$nombre_p]['pasado']++;
                }
            }
        }
    }
    ?>

    <?php foreach ($stats as $nombre => $cant): ?>
        <div style="flex: 1; background: #f3f5f4; border-top: 4px solid #2e4356; padding: 10px; border-radius: 4px; text-align: center; box-shadow: 1px 1px 5px rgba(0,0,0,0.1);">
            <strong style="color: #2e4356; display: block; margin-bottom: 5px;"><?php echo $nombre; ?></strong>
            <span style="font-size: 0.85em; color: #555;">Este mes: <b><?php echo $cant['actual']; ?></b></span><br>
            <span style="font-size: 0.85em; color: #888;">Mes pasado: <?php echo $cant['pasado']; ?></span>
        </div>
    <?php endforeach; ?>
</div>

<button class="insertarbtn" onclick="cargarSeccion('form_registrar_pago')">Registrar Nuevo Pago</button>

<table border="1" style="width:100%; border-collapse: collapse; margin-top:20px;">
    <thead style="background:#2e4356; color:white;">
        <tr>
            <th style="padding:10px;">ID</th>
            <th>Cliente / Estudiante</th>
            <th>Plan</th>
            <th>Método</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pagos as $p): ?>
        <tr>
            <td style="padding:10px;"><?php echo $p['idPagos']; ?></td>
            <td><?php echo $p['cliente_nombre']; ?></td>
            <td><?php echo $p['plan_nombre']; ?></td>
            <td><?php echo $p['tipo']; ?></td>
            <td><?php echo $p['fecha']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>