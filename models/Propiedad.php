<?php

namespace Model;

class Propiedad extends ActiveRecord
{
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    public function __construct($args = []) // El constructor
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? '';
    }

    public function validar() // Validamos cada atributo tenga los datos del formulario
    {
        if (!$this->titulo) {
            self::$errores[] = "Debes agregar un titulo";
        }
        if (!$this->precio) {
            self::$errores[] = "El precio es obligatorio";
        }
        if (strlen($this->descripcion) < 50) {
            self::$errores[] = "La descripcion es obligatoria y debe tener minimo 50 caracteres";
        }
        if (!$this->habitaciones) {
            self::$errores[] = "Agrege un numero de habitaciones";
        }
        if (!$this->wc) {
            self::$errores[] = "Agrege un numero de baños";
        }
        if (!$this->estacionamiento) {
            self::$errores[] = "Agrege un numero de estacionamientos";
        }
        if (!$this->vendedores_id) {
            self::$errores[] = "Elige un vendedor";
        }
        if (!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }

        return self::$errores;
    }
}
