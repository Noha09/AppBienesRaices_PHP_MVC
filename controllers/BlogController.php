<?php

namespace Controllers;

use Model\Blog;
use MVC\Router;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;


class BlogController
{
    public static function create(Router $router)
    {
        estaAutenticado();

        $blog = new Blog;
        $vendedores = Vendedor::all();
        $errores = Blog::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $blog = new Blog($_POST['blog']);

            $nombreIMG = md5(uniqid(rand(), true)) . '.jpg';

            if ($_FILES['blog']['tmp_name']['imagen']) {
                $imagen = Image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800, 600);
                $blog->setImagen($nombreIMG);
            }

            $errores = $blog->validar();

            if (empty($errores)) {
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                $imagen->save(CARPETA_IMAGENES . $nombreIMG);

                $blog->guardar();
            }
        }

        $router->render('blog/crear', [
            'blog' => $blog,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function update(Router $router)
    {
        estaAutenticado();

        $id = validarORedireccionar('/public/index.php/admin');

        $blog = Blog::find($id);
        $vendedores = Vendedor::all();
        $errores = Blog::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $args = $_POST['blog'];

            $blog->sincronizar($args);

            $errores = $blog->validar();

            $nombreIMG = md5(uniqid(rand(), true)) . '.jpg';

            if ($_FILES['blog']['tmp_name']['imagen']) {
                $imagen = Image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800, 600);
                $blog->setImagen($nombreIMG);
            }

            if (empty($errores)) {
                if ($_FILES['blog']['tmp_name']['imagen']) {
                    $imagen->save(CARPETA_IMAGENES . $nombreIMG);
                }

                $blog->guardar();
            }
        }

        $router->render('blog/actualizar', [
            'blog' => $blog,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function delete(Router $router)
    {
        estaAutenticado();

        $id = validarORedireccionar('/public/index.php/admin');

        $blog = Blog::find($id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    if ($tipo === 'blog') {
                        $blog = Blog::find($id);
                        $blog->eliminar();
                    }
                }
            }
        }

        $router->render('blog/eliminar', [
            'blog' => $blog
        ]);
    }
}
