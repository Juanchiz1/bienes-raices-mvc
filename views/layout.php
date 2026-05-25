<?php
if(!isset($_SESSION)){
    session_start();
}

$auth = $_SESSION['login'] ?? false;

if(!isset($inicio)){
    $inicio = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="Boton Dark Mode">
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Propiedades</a>
                        <a href="/blog">Blog</a>
                        <a href="/entrada">Entrada</a>
                        <a href="/contacto">Contacto</a>
                        <?php if($auth): ?>
                            <a href="/admin">Admin</a>
                            <a href="/logout">Cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
            <?php echo $inicio ? "<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>" : ''; ?>
        </div>
    </header>

    <?php echo $contenido; ?>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/propiedades">Propiedades</a>
                <a href="/blog">Blog</a>
                <a href="/entrada">Entrada</a>
                <a href="/contacto">Contacto</a>
            </nav>
            <p class="copyright">Todos los derechos reservados <?php echo date('Y'); ?> &copy;</p>
        </div>
    </footer>
    
    <!-- Usamos una ruta relativa para asegurar que encuentre el archivo -->
    <script src="build/js/app.js?v=<?php echo time(); ?>"></script>
</body>
</html>
