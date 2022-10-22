<?php

namespace MVC;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function __construct()
    {
    }

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
        $auth = $_SESSION['login'] ?? null;

        /* Arreglos de rutas protegidas */
        $ruta_protegidas = ['/admin', '/propiedades/crear' , '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear' , '/vendedores/actualizar', '/vendedores/eliminar'];

        // $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $urlActual = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['REQUEST_URI'];
        $metodo = $_SERVER['REQUEST_METHOD'];

        //dividimos la URL actual cada vez que exista un '?' eso indica que se están pasando variables por la url
        $splitURL = explode('?', $urlActual);
        
        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$splitURL[0]] ?? null;
        } else {
            $fn = $this->rutasPOST[$splitURL[0]] ?? null;
        }

        /* Proteger las rutas */
        if(in_array($urlActual, $ruta_protegidas) && !$auth){
            header('Location: /');
        }

        if ($fn) {
            /* La url existe y hay una funcion asociada */
            /* Llama una funcion cuando no sabemos como se llama */
            call_user_func($fn, $this);
        } else {
            // echo "Pagina NO encontrada";
            http_response_code(404);
            die();
        }
    }

    /* Muestra una vista, guardar la vista en memoria para hacerlo dinamico */
    public function render($view, $datos = [])
    {   
        /* El doble $$ significa la variable de variable, matiene el nombre y no pierde el valor */
        foreach($datos as $key => $value){
            $$key = $value;
        }

        ob_start(); /* Almacenamiento en memoria durante un momento ... */

        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); /* Limpia el Buffer */
        include __DIR__ . "/views/layout.php";
    }
}
