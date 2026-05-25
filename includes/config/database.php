<?php 

if (!function_exists('conectarDB')) {
    function conectarDB() {
        // tu código de conexión
        $db= new mysqli('localhost','root','admin','bienesraices_crud',3307);

    if(!$db){
        echo "Error no se pudo conectar a la base de datos";
        exit;
    }

    return $db;
    }
}