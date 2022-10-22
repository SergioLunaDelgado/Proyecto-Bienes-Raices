<?php
    /* Ya no es necesario tener la forma de funcion (mysqli_connect) sino de objeto */
    function conectarDB() : mysqli {
        $db = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_BD']);
        $db->set_charset("utf8");

        if(!$db){
            echo "Error en la conexion";
            exit;
        }
        return $db;
    }