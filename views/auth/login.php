<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario" action="/login">
        <fieldset>
            <legend>Email y password</legend>

            <label for="e-mail">E-mail</label>
            <input type="email" name="email" placeholder="Tú correo" id="e-mail">

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Tú contraseña" id="password">
        </fieldset>

        <input type="submit" class="boton boton-verde" value="Iniciar Sesión">
    </form>
</main>