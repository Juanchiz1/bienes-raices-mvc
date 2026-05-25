<?php

namespace MVC;

class Router {
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas() {
        $urlActual = $_SERVER['PATH_INFO'] ?? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $metodo = $_SERVER['REQUEST_METHOD'];

        $rutas = $metodo === 'GET' ? $this->rutasGET : $this->rutasPOST;

        foreach ($rutas as $ruta => $fn) {
            if ($ruta === $urlActual) {
                call_user_func($fn, $this);
                return;
            }
        }

        http_response_code(404);
        echo "Página no encontrada";
    }

    public function render($view, $datos = []) {
        foreach ($datos as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include __DIR__ . "/../views/$view.php";
        $contenido = ob_get_clean();
        include __DIR__ . "/../views/layout.php";
    }
}
