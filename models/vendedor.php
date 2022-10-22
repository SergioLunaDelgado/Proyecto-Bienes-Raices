<?php

namespace Model;

class Vendedor extends ActiveRecord{
    
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validar()
    {
        if (!$this->nombre) {
            self::$errores[] = "Debes añadir un nombre";
        }
        if (!$this->apellido) {
            self::$errores[] = "Debes añadir un apellido";
        }
        if (!$this->telefono) {
            self::$errores[] = "El telefono es obligatorio y debe tener 10 caracteres de extensión";
        }
        /* Esta es una expresion regular */
        if(!preg_match("/[0-9]{10}/", $this->telefono) or strlen($this->telefono) > 10) {
            self::$errores[] = "Formato de teléfono no válido y debe tener 10 caracteres de extensión";
        }
        
        return static::$errores;
    }
}