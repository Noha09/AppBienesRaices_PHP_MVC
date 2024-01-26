<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Model\Blog;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{
    public static function index(Router $router)
    {
        estaAutenticado();

        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $blogs = Blog::all();

        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'blogs' => $blogs,
            'resultado' => $resultado
        ]);
    }

    public static function create(Router $router)
    {
        estaAutenticado();

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propiedad = new Propiedad($_POST['propiedad']); // Creamos un nuevoo objeto

            $nombreIMG = md5(uniqid(rand(), true)) . '.jpg'; // Generar un nombre unico

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600); // Creamos / seteamos la imagen
                $propiedad->setImagen($nombreIMG);
            }

            $errores = $propiedad->validar(); // Validamos los datos

            if (empty($errores)) { // Revisar que no hallan errores
                if (!is_dir(CARPETA_IMAGENES)) { // Crear carpeta de img
                    mkdir(CARPETA_IMAGENES);
                }

                $image->save(CARPETA_IMAGENES . $nombreIMG); // Guardamos la imagen

                $propiedad->guardar(); // Guardamos los datos
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function update(Router $router)
    {
        estaAutenticado();

        $id = validarORedireccionar('/public/index.php/admin');

        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") { // Ejecutar el codico despues de enviar el formulario
            $args = $_POST['propiedad'];

            $propiedad->sincronizar($args); // Sincronizacion

            $errores = $propiedad->validar(); // Validacion

            $nombreIMG = md5(uniqid(rand(), true)) . '.jpg'; // Generar un nombre unico

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600); // Creamos / seteamos la imagen
                $propiedad->setImagen($nombreIMG);
            }

            if (empty($errores)) { // Revisar que no hallan errores
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreIMG);
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

    public static function delete(Router $router)
    {
        estaAutenticado();

        $id = validarORedireccionar('/public/index.php/admin');

        $propiedad = Propiedad::find($id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    if ($tipo === 'propiedad') {
                        $propiedad = Propiedad::find($id);
                        $propiedad->eliminar();
                    }
                }
            }
        }

        $router->render('propiedades/eliminar', [
            'propiedad' => $propiedad
        ]);
    }
}
