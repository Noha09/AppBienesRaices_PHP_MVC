<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController
{
    public static function create(Router $router)
    {
        estaAutenticado();

        $vendedor = new Vendedor;
        $errores = Vendedor::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $vendedor = new Vendedor($_POST['vendedor']);

            $errores = $vendedor->validar();

            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('/vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function update(Router $router)
    {
        estaAutenticado();

        $id = validarORedireccionar('/public/index.php/admin');

        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $args = $_POST['vendedor'];

            $vendedor->sincronizar($args);

            $errores = $vendedor->validar();

            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('/vendedores/actualizar', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function delete(Router $router)
    {
        estaAutenticado();

        $id = validarORedireccionar('/public/index.php/admin');

        $vendedor = Vendedor::find($id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    if ($tipo === 'vendedor') {
                        $vendedor = Vendedor::find($id);
                        $vendedor->eliminar();
                    }
                }
            }
        }

        $router->render('vendedores/eliminar', [
            'vendedor' => $vendedor
        ]);
    }
}
