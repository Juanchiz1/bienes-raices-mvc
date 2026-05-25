<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$auth = $_SESSION['login'] ?? null;
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Bienes Raices</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/build/css/app.css">
    </head>
    <body>
        <header class="header <?php echo $inicio === true ? 'inicio' : ''; ?>">
    <div class="contenedor contenido-header">
        <div class="barra">
            <a href="index.php">
                <img src="/build/img/logo.svg" alt="logo tipo de bienes raices">
            </a>

            <div class="mobile-menu">
                <img src="/build/img/barras.svg" alt="icono menu">
            </div>

            <div class="derecha">
                <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="modo oscuro">
                <nav class="navegacion">
                    <a href="nosotros.php">Nosotros</a>
                    <a href="anuncios.php">Anuncios</a>
                    <a href="blog.php">Blog</a>
                    <a href="contacto.php">Contacto</a>
                    <?php if($auth): ?>
                        <a href="cerrar-sesion.php">Cerrar Sesión</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div> <!-- Cierre de barra -->

        <?php if($inicio){ 
          echo '<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>';
        } ?>
    </div>
</header>