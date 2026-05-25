<fieldset >
    <legend>Información del Vendedor</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre Vendedor" value="<?php echo s($vendedor->nombre); ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido Vendedor" value="<?php echo s($vendedor->apellido); ?>">

    <label for="telefono">Teléfono:</label>
    <input type="tel" id="telefono" name="vendedor[telefono]" placeholder="Teléfono Vendedor" value="<?php echo s($vendedor->telefono); ?>">
</fieldset>
