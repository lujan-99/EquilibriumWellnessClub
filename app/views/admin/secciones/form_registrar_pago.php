<div class="form-container">
    <h2>Nuevo Pago</h2>
    <form id="formInsertarPago">
        <label>Estudiante:</label>
        <select name="idCliente" required>
            <?php foreach ($clientes as $c): ?>
                <option value="<?php echo $c['idCliente']; ?>"><?php echo $c['nombre']; ?></option>
            <?php endforeach; ?>
        </select>

        <label>Plan:</label>
        <select name="idPlan" required>
            <?php foreach ($planes as $pl): ?>
                <option value="<?php echo $pl['idPlan']; ?>"><?php echo $pl['nombre_plan']; ?></option>
            <?php endforeach; ?>
        </select>

        <label>Método:</label>
        <select name="tipo">
            <option value="Efectivo">Efectivo</option>
            <option value="Transferencia">Transferencia</option>
            <option value="QR">QR</option>
        </select>

        <label>Fecha:</label>
        <input type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>" required>

        <button type="submit" class="insertarbtn">Guardar Pago</button>
    </form>
</div>