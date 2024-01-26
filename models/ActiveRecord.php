<?php

namespace Model;

class ActiveRecord
{
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';
    protected static $errores = [];

    public static function setDB($database) // Traemos la coneccion a la DB
    {
        self::$db = $database;
    }

    public static function getErrores() // Declaramos un arreglo vacio
    {
        return static::$errores;
    }

    public static function get($cantidad) // Lista todos los registros
    {
        $query = "SELECT * FROM " . static::$tabla . ' LIMIT ' . $cantidad . ";";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function all() // Lista todos los registros
    {
        $query = "SELECT * FROM " . static::$tabla . ' ;';

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function find($id) // Busca un registro por su id
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id=$id;";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function consultarSQL($query)
    {
        $resultado = self::$db->query($query);

        $array = [];

        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        $resultado->free();

        return $array;
    }

    protected static function crearObjeto($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    public function atributos() // Asignamos los datos del formulario a los atributos del objeto
    {
        $atributos = [];

        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }

    public function setImagen($imagen) // Subir img
    {
        if (!is_null($this->id)) {
            $this->borrarIMG();
        }

        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    public function borrarIMG()
    {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);

        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    public function validar() // Validamos cada atributo tenga los datos del formulario
    {
        static::$errores = [];
        return static::$errores;
    }

    public function sanitizarAtributos() // Sanitizamos los valores en los atributos
    {
        $atributos = $this->atributos();

        $sanitizados = [];

        foreach ($atributos as $key => $value) {
            $sanitizados[$key] = self::$db->escape_string($value);
        }

        return $sanitizados;
    }

    public function guardar()
    {
        if (!is_null($this->id)) {
            $this->actualizar();
        } else {
            $this->crear();
        }
    }

    public function crear() // Insertamos en la BD
    {
        $atributos = $this->sanitizarAtributos();

        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "');";

        $resultado = self::$db->query($query);

        if ($resultado) {
            header('location: /public/index.php/admin?resultado=1'); // Redireccionar al usuario para evitar valores duplicados
        }
    }

    public function actualizar() // Actualizamos en la DB
    {
        $atributos = $this->sanitizarAtributos();

        $valores = [];

        foreach ($atributos as $key => $value) {
            $valores[] = "$key = '$value'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(", ", $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1;";

        $resultado = self::$db->query($query);

        if ($resultado) {
            header('location: /public/index.php/admin?resultado=2'); // Redireccionar al usuario para evitar valores duplicados
        }
    }

    public function eliminar()
    {
        //Eliminar la propiedad
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->borrarIMG();
            header('Location: /public/index.php/admin?resultado=3');
        }
    }
}
