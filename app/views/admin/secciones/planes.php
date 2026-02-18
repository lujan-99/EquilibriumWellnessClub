<h1 style="color: #2e4356; background-color: #f3f5f4; padding: 10px;">Administrar Planes</h1>
<button class="insertarbtn" onclick="cargarSeccion('form_registrar_plan')">Insertar Nuevo Plan</button>

<table border="1" style="width:100%; border-collapse: collapse; margin-top:20px;">
    <thead>
        <tr style="background:#2e4356; color:white;">
            <th>ID</th>
            <th>Nombre del Plan</th>
            <th>Duración (Meses)</th>
            <th>Operaciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($planes as $p): ?>
            <tr>
                <td><?php echo $p['idPlan']; ?></td>
                <td><?php echo $p['nombre_plan']; ?></td>
                <td><?php echo $p['duracion_meses']; ?></td>
                <td>
                    <button class="editarbtn" onclick="editarPlan(<?php echo $p['idPlan']; ?>)">Editar</button>
                    <button class="eliminarbtn" onclick="eliminarPlan(<?php echo $p['idPlan']; ?>)">Eliminar</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>