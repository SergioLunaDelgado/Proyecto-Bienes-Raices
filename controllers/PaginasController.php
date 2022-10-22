<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;

use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {
        $inicio = true;
        $propiedades = Propiedad::get(3);

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros', []);
    }

    public static function anuncios(Router $router)
    {
        $propiedades = Propiedad::all();

        $router->render('paginas/anuncios', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router)
    {
        $id = validarORedireccionar('/propiedades');
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router)
    {
        $router->render('paginas/blog', []);
    }

    public static function entrada(Router $router)
    {
        $router->render('paginas/entrada', []);
    }

    public static function contacto(Router $router)
    {
        $mensaje = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuestas = $_POST['contacto'];

            /* Crear una instancia de PHPMailer */
            $mail = new PHPMailer();

            /* Configurar SMTP = Protocolo de envio de email, HTTP visitar sitios web 
            Este pedazo de codigo es la parte de arriba del correo */
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'c85601fe296031';
            $mail->Password = 'c0358a761922db';
            $mail->SMTPSecure = 'tls'; /* transport leyend security, ya no se usa ssl (secury socket player) */
            $mail->Port = 2525;

            /* Configurar el contenido del mail */
            $mail->setFrom('admin@bienesraices.com'); /* quien envia el email, se puede colocar el email de la persona que nos quiere contactar, es mejor como lo tenemos porque es posible que se envie a la bandeja de no desados */
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com'); /* A que email le va llegar el correo */
            $mail->Subject = 'Tienes un Nuevo Mensaje'; /* Asunto */

            /* Habilitar HTML */
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            /* Definir el contenido */
            $contenido = '<html>';
            $contenido .= '<h1 style="color: blue;">Tienes un nuevo mensaje</h1>';
            $contenido .= '<p><b>Nombre:</b> ' . $respuestas['nombre'] . '</p>';

            /* Enviar de forma condicional algunos campos de email o telefono */
            if ($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p><b>Eligio ser contactado por telefono</b></p>';
                $contenido .= '<p><b>Telefono:</b> ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p><b>Fecha de contacto:</b> ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p><b>Hora de contacto:</b> ' . $respuestas['hora'] . '</p>';
            } else {
                $contenido .= '<p><b>Eligio ser contactado por correo electronico</b></p>';
                $contenido .= '<p><b>Email:</b> ' . $respuestas['email'] . '</p>';
            }

            $contenido .= '<p><b>Mensaje:</b> ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p><b>Tipo de servicio:</b> ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p><b>Precio:</b> $' . $respuestas['precio'] . '</p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML'; /* Por si no acepta diseño HTML */

            /* Enviar el email */
            if ($mail->send()) {
                $mensaje = "Mensaje enviado Correctamente";
            } else {
                $mensaje = "Mensaje NO enviado";
            }
        }

        $router->render('paginas/contacto', [
            "mensaje" => $mensaje
        ]);
    }
}
