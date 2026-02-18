<h1 style="color: #2e4356; background-color: #f3f5f4; padding: 10px;">Historial de Pagos</h1>
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