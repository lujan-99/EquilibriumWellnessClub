<form id="formEditarCliente">
    <input type="hidden" name="idCliente" value="<?php echo $cliente['idCliente']; ?>">
    
    <input type="text" name="nombre" value="<?php echo $cliente['nombre']; ?>" required>
    <input type="email" name="gmail" value="<?php echo $cliente['gmail']; ?>" required>
    <select name="sexo">
        <option value="Masculino" <?php echo ($cliente['sexo'] == 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
        <option value="Femenino" <?php echo ($cliente['sexo'] == 'Femenino') ? 'selected' : ''; ?>>Femenino</option>
    </select>
    <input type="date" name="fecha_i" value="<?php echo $cliente['fecha_i']; ?>" required>
    
    <button type="submit">Actualizar Cambios</button>
</form>