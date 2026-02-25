<h1 style="color: #2e4356; background-color: #f3f5f4; padding: 10px;">Administrador de Avisos</h1>
<button class="insertarbtn" onclick="cargarSeccion('form_registrar_aviso')">Crear Nuevo Aviso</button>

<table border="1" style="width:100%; border-collapse: collapse; margin-top:20px;">
    <thead style="background:#2e4356; color:white;">
        <tr>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Destinatario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>   
        <?php foreach ($avisos as $a): ?>
            <tr>
                <td><?php echo $a['fecha']; ?></td>
                <td><?php echo $a['descripcion']; ?></td>
                <td>
                    <?php 
                        if ($a['cliente_nom']) echo "Cliente: " . $a['cliente_nom'];
                        elseif ($a['plan_nom']) echo "Plan: " . $a['plan_nom'];
                        else echo "<b>General (Todos)</b>";
                    ?>
                </td>
                <td>
                    <button class="eliminarbtn" onclick="eliminarAviso(<?php echo $a['idAviso']; ?>)">Eliminar</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>