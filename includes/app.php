<?php

/* Este es un archivo que manda a llamar funciones. bases de datos y clases */
require __DIR__ . '/../vendor/autoload.php';

// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->safeLoad(); /* Si un archivo no existe no marca error */


require 'funciones.php';
require 'config/database.php';

/* Conectar base de datos */
$db = conectarDB();
use Model\ActiveRecord;
ActiveRecord::setDB($db);