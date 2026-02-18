<div class="form-container">
    <h2 style="color: #2e4356; background-color: #f3f5f4; padding: 10px; border-radius: 5px;">
        Registrar Nuevo Cliente / Estudiante
    </h2>

    <form id="formInsertarCliente" style="display: grid; gap: 15px; max-width: 500px; margin-top: 20px;">
        
        <label>Nombre Completo:</label>
        <input type="text" name="nombre" placeholder="Ej. Juan Perez" required>

        <label>Correo Electrónico:</label>
        <input type="email" name="gmail" placeholder="ejemplo@gmail.com" required>

        <label>Sexo:</label>
        <select name="sexo" required>
            <option value="">Seleccione una opción</option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
            <option value="Otro">Otro</option>
        </select>

        <label>Fecha de Inicio:</label>
        <input type="date" name="fecha_i" value="<?php echo date('Y-m-d'); ?>" required>

        <label>Fecha de Finalización (Opcional):</label>
        <input type="date" name="fecha_fin">

        <div style="margin-top: 10px;">
            <button type="submit" class="insertarbtn">Guardar Cliente</button>
            <button type="button" class="eliminarbtn" onclick="cargarSeccion('clientes')">Cancelar</button>
        </div>
    </form>
</div>