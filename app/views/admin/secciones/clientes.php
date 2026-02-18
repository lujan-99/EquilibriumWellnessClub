<h1 style="color: #2e4356; background-color: #f3f5f4; padding: 10px;">Listado de Clientes</h1>

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