<?php

namespace Model;

class ActiveRecord
{
    /* Base de datos, como es estatica no se va a reescribir nunca */
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';
    /* Errores */
    protected static $errores = [];

    /* Definir la conexion a la BD */
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function save()
    {
        if (!is_null($this->id)) {
            /* Actualizar */
            $this->update();
        } else {
            /* Crear */
            $this->insert();
        }
    }

    /* Insertar en la base de datos */
    public function insert()
    {
        /* Sanitizar los datos */
        $atributos = $this->sanitizarAtributos();

        /* join crea un string apartir de un array */
        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "')";

        $resultado = self::$db->query($query);

        /* Mensaje de exito o error */
        if ($resultado) {
            echo "<script>alert('El registro se ha insertado correctamente'); window.location.href = '/admin';</script>";
            // header('Location: /admin');
        } else {
            echo "<script>alert('Error al insertar el registro');</script>";
        }
    }

    public function update()
    {
        /* Sanitizar los datos */
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        if ($resultado) {
            echo "<script>alert('El registro se ha actualizado correctamente'); window.location.href = '/admin';</script>";
        } else {
            echo "<script>alert('Error al insertar el registro');</script>";
        }
    }

    public function delete()
    {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";

        $resultado = self::$db->query($query);
        if ($resultado && static::$tabla === 'propiedades') {
            $this->borrarImagen();
            echo "<script>alert('El registro $this->id se ha borrado correctamente'); window.location.href = '/admin';</script>";
        } else {
            echo "<script>alert('El registro $this->id se ha borrado correctamente'); window.location.href = '/admin';</script>";
        }
    }

    /* Identificar y unir los atributos de la bd - Mapea las columnas */
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue; /* Se salta el id */
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        /* Arreglos asociativos */
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    /* Subida de archivos */
    public function setImagen($imagen)
    {
        /* Elimina la imagen previa */
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }

        /* Asignar el atributo de imagen el nombre del archivo */
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    /* Eliminar el archivo */
    public function borrarImagen()
    {
        /* Comprobar si existe archivo */
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    /* Validacion */
    public static function getErrores()
    {
        return static::$errores;
    }

    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }

    /* Listar todas las propiedades */
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    /* Obtener determinado numero de registros */
    public static function get($cantidad)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    /* Busca un registro */
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function consultarSQL($query)
    {
        /* Consultar la base de datos */
        $resultado = self::$db->query($query);

        /* Iterar los resultados, va crear muchos arreglos de objetos */
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        /* Liberar la memoria */
        $resultado->free();

        /* Retornar los resultados */
        return $array;
    }

    protected static function crearObjeto($registro)
    {
        /* Nuevos objetos de la clase padre */
        $objeto = new static;
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    /* Sincroniza el objeto en memoria con los cambios realizados por el usuario */
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
