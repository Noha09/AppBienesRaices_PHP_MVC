<?php
define('TEMPLATES_URL', __DIR__ . '\templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/public/imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/$nombre.php";
}

function estaAutenticado()
{
    session_start();

    if (!$_SESSION['login']) {
        header('location: /');
    }
}

function debuguear($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";

    exit;
}

function s($html): string
{
    $s = htmlspecialchars($html);

    return $s;
}

function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad', 'blog'];
    return in_array($tipo, $tipos);
}


function mostrarNotificacion($codigo)
{
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creado correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}

function buscarErrores()
{
    //mostrar errores php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

function validarORedireccionar(string $url)
{
    $id = $_GET['id']; // Leemos el id de la propiedad
    $id = filter_var($id, FILTER_VALIDATE_INT); // Validamos que sea un id valido, valgame la redundancia

    if (!$id) {
        header("location: $url"); // Redireccionamos si no lo es
    }

    return $id;
}
