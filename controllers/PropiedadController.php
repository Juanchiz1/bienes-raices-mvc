<?php
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {
    public static function index(Router $router) {
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $router->render("propiedades/admin", [
            "propiedades" => $propiedades,
            "resultado" => $_GET["resultado"] ?? null,
            "vendedores" => $vendedores
        ]);
    }


    public static function crear(Router $router) {
       $propiedad = new Propiedad();
       $vendedores = Vendedor::all();

       $errores = Propiedad::getErrores();

       if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $propiedad = new Propiedad($_POST['propiedad']);

        // Generar un nombre único para la imagen
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        // Setear la imagen
        if ($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            $propiedad->setImagen($nombreImagen);
        }

        $errores = $propiedad->validar();

        if (empty($errores)) {
            // Crear carpeta para subir las imágenes si no existe
            if (!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }

            // Guardar la imagen en el servidor
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }

            $propiedad->guardar();
        }
       }

         $router->render('propiedades/crear', [
          'propiedad' => $propiedad,
          'vendedores' => $vendedores,
          'errores' => $errores
         ]);




    }

    public static function actualizar(Router $router) {
        // Lógica para actualizar una propiedad existente
        $propiedad = Propiedad::find($_GET['id']);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propiedad->sincronizar($_POST["propiedad"]);
            $errores = $propiedad->getErrores();

            if (empty($errores)) {
                $propiedad->guardar();
            }
        }

        //metodo post para actualizar la imagen
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['propiedad'];
            $propiedad->sincronizar($args);
            $errores = $propiedad->validar();

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            if (empty($errores)) {
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $propiedad->guardar();
            }

        }


        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function eliminar() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $tipo = $_POST["tipo"];
                if (validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }


}