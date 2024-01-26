<?php

namespace Model;

class Blog extends ActiveRecord
{
    protected static $tabla = 'blog';
    protected static $columnasDB = ['id', 'titulo', 'contenido', 'resumen', 'fecha', 'imagen', 'vendedorId'];

    public $id;
    public $titulo;
    public $contenido;
    public $resumen;
    public $fecha;
    public $imagen;
    public $vendedorId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->contenido = $args['contenido'] ?? '';
        $this->resumen = $args['resumen'] ?? '';
        $this->fecha = date('Y/m/d');
        $this->imagen = $args['imagen'] ?? '';
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function validar()
    {
        if (!$this->titulo) {
            self::$errores[] = "Debes agregar un titulo";
        }
        if (strlen($this->contenido) < 100) {
            self::$errores[] = "El contenido es obligatorio y debe tener manimo 100 caracteres";
        }
        if (strlen($this->resumen) > 255 || strlen($this->resumen) < 50) {
            self::$errores[] = "El resumen es obligatorio y debe tener maximo 255 caracteres y minimo 50";
        }
        if (!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }
        if (!$this->vendedorId) {
            self::$errores[] = "Elige un vendedor";
        }

        return self::$errores;
    }
}
