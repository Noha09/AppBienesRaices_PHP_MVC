<?php

namespace MVC;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {
        session_start();

        $login = $_SESSION['login'] ?? null;

        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar', '/blog/crear', '/blog/actualizar', '/blog/eliminar'];

        $URLActual = $_SERVER['PATH_INFO'] ?? '/';

        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$URLActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$URLActual] ?? null;
        }

        if (in_array($URLActual, $rutas_protegidas) && !$login) {
            header('Location /public/index.php');
        }

        if ($fn) { // La URL existe y tiene una funcion asociada
            call_user_func($fn, $this);
        } else {
            echo "Pagina no encontrada";
        }
    }

    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $values) {
            $$key = $values;
        }

        ob_start();

        include __DIR__ . '/views/' . $view . '.php';

        $contenido = ob_get_clean();

        include __DIR__ . '/views/layout.php';
    }
}
