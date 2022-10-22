<fieldset>
    <legend>Informacion General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" name="vendedor[nombre]" id="nombre" placeholder="Nombre del vendedor(a)" value="<?php echo s($vendedor->nombre); ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" name="vendedor[apellido]" id="apellido" placeholder="Apellido del vendedor(a)" value="<?php echo s($vendedor->apellido); ?>">

</fieldset>
<fieldset>
    <legend>Informacion Extra</legend>

    <label for="telefono">Télefono:</label>
    <input type="tel" name="vendedor[telefono]" id="telefono" placeholder="Telefono del vendedor(a)" value="<?php echo s($vendedor->telefono); ?>">

</fieldset>