<?php
if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? false;
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="../build/css/app.css">
</head>

<body>

    <header class="header <?php echo $inicio  ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="index.php">
                    <img src="/build/img/logo.svg" alt="Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Menu Mobil">
                </div>

                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" alt="Dark Mode" class="dark-mode-boton">
                    <nav class="navegacion">
                        <a class="b-inicio" href="index.php">Inicio</a>
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                        <?php if($auth): ?>
                            <a href="/logout">Cerrar Sesión</a>
                        <?php endif; ?>

                    </nav>
                </div>
            </div> <!--w.barra-->

            <?php if ($inicio)
                echo '<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>';
            ?>


        </div>
    </header>