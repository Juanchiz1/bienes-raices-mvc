<fieldset>
    <legend>Información General</legend>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" value="<?php echo $vendedor->nombre ?? ''; ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" value="<?php echo $vendedor->apellido ?? ''; ?>">
</fieldset>

<fieldset>
    <legend>Información de Contacto</legend>
    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="vendedor[telefono]" value="<?php echo $vendedor->telefono ?? ''; ?>">
</fieldset>