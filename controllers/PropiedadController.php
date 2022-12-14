<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;

use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{
    /* Con este argumento mantenemos viva la referencia */
    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();

        $router->render('propiedades/admin', [
            'mensaje' => 'Desde la vista',
            'propiedades' => $propiedades,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router)
    {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();

        /* Arreglo con mensaje de error */
        $errores = Propiedad::getErrores();

        /* Ejecutar el codigo despues de que el usuario envia el formulario */
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            /* Crea una nueva instancia */
            $propiedad = new Propiedad($_POST['propiedad']);

            /* Generar un nombre unico */
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            /* Realiza un resize a la imagen con intervention, fit mezcla resize y crock */
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            /* Validar */
            $errores = $propiedad->validar();

            /* Revisar que el arreglo de errores este vacio */
            if (empty($errores)) {

                /* Crear la carpeta para subir imagenes */
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                /* Guardar la imagen en el servidor */
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                /* Guarda en la base de datos */
                $propiedad->insert();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad'     => $propiedad,
            'vendedores'    => $vendedores,
            'errores'       => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/admin');

        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();

        /* Arreglo con mensaje de error */
        $errores = Propiedad::getErrores();

        /* Ejecutar el codigo despues de que el usuario envia el formulario */
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            /* Asignar los atributos */
            $args = $_POST['propiedad'];

            $propiedad->sincronizar($args);

            /* Validacion */
            $errores = $propiedad->validar();

            /* Generar un nombre unico */
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            /* Subida de archivos */
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            /* Revisar que el arreglo de errores este vacio */
            if (empty($errores)) {

                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $propiedad->save();
            }
        }

        $router->render('propiedades/actualizar', [
            'propiedad'     => $propiedad,
            'vendedores'    => $vendedores,
            'errores'       => $errores
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id) {
                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->delete();
                }
            } else {
                echo "<script>alert('Error al borrar el registro');</script>";
            }
        }
    }
}
