<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once 'config/database.php';
require_once 'funciones.php';

use Model\Activerecord;

$db = conectarDB();

Activerecord::setDB($db);

// Definir constantes globales aquí para evitar redefiniciones
if (!defined('TEMPLATES_URL')) {
    define('TEMPLATES_URL', __DIR__ . '/templates');
}
if (!defined('FUNCIONES_URL')) {
    define('FUNCIONES_URL', __DIR__ . '/funciones.php');
}
if (!defined('CARPETA_IMAGENES')) {
    define('CARPETA_IMAGENES', __DIR__ . '/../public/imagenes/');
}