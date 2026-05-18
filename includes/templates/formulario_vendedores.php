<fieldset>
    <legend>Información general</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre del vendedor(a)"
        value="<?php echo s($vendedor->nombre)  ?>">

    <label for="Apellido">Apellido:</label>
    <input type="text" id="Apellido" name="vendedor[Apellido]" placeholder="Apellido del vendedor(a)"
        value="<?php echo s($vendedor->Apellido)  ?>">
</fieldset>

<fieldset>
    <legend>Información extra</legend>


    <label for="telefono">Telefono:</label>
    <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Telefono del vendedor(a)"
        value="<?php echo s($vendedor->telefono)  ?>">
</fieldset>