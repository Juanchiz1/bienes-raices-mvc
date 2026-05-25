<?php

// Las constantes TEMPLATES_URL, FUNCIONES_URL y CARPETA_IMAGENES ahora se definen en app.php
// para evitar redefiniciones y asegurar un único punto de configuración.

function incluirTemplate( string $nombre, bool $inicio = false) {
    $ruta = TEMPLATES_URL . '/' . $nombre . '.php';
    
    if (file_exists($ruta)) {
        include $ruta;
    } else {
        echo "Error: Template '{$nombre}' no encontrado en {$ruta}";
    }
}

function estaAutenticado(): bool {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['login']) && $_SESSION['login'] === true;
}

function debuguear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
};

function s($html): string {
    return htmlspecialchars($html, ENT_QUOTES, 'UTF-8');
}

function validarTipoContenido($tipo) {
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);
}

function mostrarNotificacion($codigo) {
    $mensaje = '';
    switch ($codigo) {
        case 1:
            $mensaje = 'Anuncio creado Correctamente';
            break;
        case 2:
            $mensaje = 'Anuncio actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Anuncio eliminado Correctamente';
            break;
        default:
            $mensaje = '';
    }
    return $mensaje;
}

function validarORedireccionar(string $url) {
    $id = $_GET['id'] ?? null;
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: {$url}");
        exit;
    }
    return $id;
}