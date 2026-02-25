<h1 style="color: #2e4356; background-color: #f3f5f4; padding: 10px;">Listado de Clientes</h1>

<div style="background-color: #2e4356; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px; display: flex; justify-content: space-around; font-size: 0.9em;">
    <?php 
    // Inicializamos contadores por si la base de datos está vacía
    $m_act = 0; $m_inact = 0; $f_act = 0; $f_inact = 0;
    $hoy = date('Y-m-d');

    if (!empty($clientes)) {
        foreach ($clientes as $c) {
            $es_activo = (!empty($c['fecha_fin']) && $c['fecha_fin'] >= $hoy);
            
            if ($c['sexo'] == 'Masculino') {
                $es_activo ? $m_act++ : $m_inact++;
            } elseif ($c['sexo'] == 'Femenino') {
                $es_activo ? $f_act++ : $f_inact++;
            }
        }
    }
    ?>
    <span><strong>Hombres:</strong> <?php echo $m_act; ?> Activos / <?php echo $m_inact; ?> Inactivos</span>
    <span>|</span>
    <span><strong>Mujeres:</strong> <?php echo $f_act; ?> Activos / <?php echo $f_inact; ?> Inactivos</span>
</div>

<button class="insertarbtn" onclick="cargarSeccion('form_registrar_cliente')">Insertar Clientes</button>

<table border="2" style="border-collapse: collapse; width: 100%; margin-top: 15px;">
    <thead>
        <tr style="background-color: #2e4356; color: white;">
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
        <?php if (!empty($clientes)): ?>
            <?php foreach ($clientes as $row): ?>
                <tr>
                    <td><?php echo $row['idCliente']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['fecha_i']; ?></td>
                    <td><?php echo $row['gmail']; ?></td>
                    <td><?php echo $row['sexo']; ?></td>
                    <td><?php echo $row['fecha_fin']; ?></td>
                    <td style="display: flex; gap: 5px; justify-content: center; padding: 5px;">
                        <button class="editarbtn" onclick="editarCliente(<?php echo $row['idCliente']; ?>)">Editar</button>
                        <button class="eliminarbtn" onclick="eliminarCliente(<?php echo $row['idCliente']; ?>)">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" style="text-align: center; padding: 10px;">No se encontraron clientes en la base de datos.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>