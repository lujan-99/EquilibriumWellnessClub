<div class="form-container">
    <h2>Publicar Aviso</h2>
    <form id="formInsertarAviso">
        <label>Fecha:</label>
        <input type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>" required>

        <label>Descripción del Aviso:</label>
        <textarea name="descripcion" required style="width:100%; height:100px;"></textarea>

        <p><small>Nota: Si no seleccionas cliente ni plan, el aviso será <b>General</b>.</small></p>

        <label>Para un Cliente específico (opcional):</label>
        <select name="idCliente">
            <option value="">-- Ninguno --</option>
            <?php foreach ($clientes as $c): ?>
                <option value="<?php echo $c['idCliente']; ?>"><?php echo $c['nombre']; ?></option>
            <?php endforeach; ?>
        </select>

        <label>O para un Plan específico (opcional):</label>
        <select name="idPlan">
            <option value="">-- Ninguno --</option>
            <?php foreach ($planes as $p): ?>
                <option value="<?php echo $p['idPlan']; ?>"><?php echo $p['nombre_plan']; ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="insertarbtn">Publicar Aviso</button>
    </form>
</div>