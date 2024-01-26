<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Blog;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);
        $blogs = Blog::get(2);

        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio,
            'blogs' => $blogs
        ]);
    }

    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::get(20);

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router)
    {
        $id = validarORedireccionar('/public/index.php/propiedades');

        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router)
    {
        $blogs = Blog::get(5);

        $router->render('paginas/blog', [
            'blogs' => $blogs
        ]);
    }

    public static function entrada(Router $router)
    {
        $id = validarORedireccionar('/public/index.php/blog');

        $blog = Blog::find($id);

        $router->render('paginas/entrada', [
            'blog' => $blog
        ]);
    }

    public static function contacto(Router $router)
    {
        $mensaje = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //debuguear($_POST);
            $respuestas = $_POST['contacto'];

            $mail = new PHPMailer(); // Crear una nueva instancia de PHPMailer

            $mail->isSMTP(); // Configurar SMTP
            $mail->Host = $_ENV ['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV['EMAIL_PORT'];
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            $mail->SMTPSecure = 'tls';

            $mail->setFrom('admin@bienesraices.com'); // Configurar el contenido del email
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';

            $mail->isHTML(true); // Habilitar HTML
            $mail->CharSet = 'UTF-8';

            $contenido = '<html>'; // Definir el contenido
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';

            if ($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Eligio ser contactado por Telefono</p>';
                $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha de contacto: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>Hora de contacto: ' . $respuestas['hora'] . '</p>';
            } else {
                $contenido .= '<p>Eligio ser contactado por Email</p>';
                $contenido .= '<p>Email: ' . $respuestas['email'] . '</p>';
            }

            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Venta o compra: ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p>Presupuesto: $' . $respuestas['presupuesto'] . '</p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es un texto alternativo sin html';

            if ($mail->send()) {
                $mensaje = 'Mensaje enviado correctamente';
            } else {
                $mensaje = 'El mensaje no se pudo enviar';
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}
