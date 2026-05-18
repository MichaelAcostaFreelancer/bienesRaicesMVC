<?php

namespace Model;

class Vendedores extends ActiveRecord
{

    protected static $tabla = 'vendedores';

    protected static $columnasDB = [
        'id',
        'nombre',
        'apellido',
        'telefono',
    ];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? null;
        $this->apellido = $args['apellido'] ?? null;
        $this->telefono = $args['telefono'] ?? null;
    }

    public function validar()
    {
        if (!$this->nombre) {
            self::$errores[] = 'El nombre es obligatorio';
        }

        if (!$this->apellido) {
            self::$errores[] = "El apellido es obligatorio";
        }

        if (!$this->telefono) {
            self::$errores[] = 'El telefono es obligatorio';
        }

        if (!preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$errores[] = 'Formato no es valido';
        }

        return self::$errores;
    }
}
