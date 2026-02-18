<div class="form-container">
    <h2 style="color: #2e4356; background-color: #f3f5f4; padding: 10px; border-radius: 5px;">
        Editar Plan de Entrenamiento
    </h2>

    <form id="formEditarPlan" style="display: grid; gap: 15px; max-width: 500px; margin-top: 20px;">
        <input type="hidden" name="idPlan" value="<?php echo $plan['idPlan']; ?>">

        <label>Nombre del Plan:</label>
        <input type="text" name="nombre_plan" required value="<?php echo $plan['nombre_plan']; ?>">

        <label>Duración (Meses):</label>
        <input type="number" name="duracion_meses" required value="<?php echo $plan['duracion_meses']; ?>">

        <div style="margin-top: 10px;">
            <button type="submit" class="insertarbtn">Actualizar Plan</button>
            <button type="button" class="eliminarbtn" onclick="cargarSeccion('planes')">Cancelar</button>
        </div>
    </form>
</div>