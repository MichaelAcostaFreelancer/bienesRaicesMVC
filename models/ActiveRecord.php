<?php

namespace Model;

class ActiveRecord
{
    //DB
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    // Errores
    protected static $errores = [];

    public $id;
    public $imagen;

    //Definir la conexión a la DB 
    public static function setDB($database)
    {
        self::$db = ($database);
    }




    public function guardar()
    {
        if (!is_null($this->id)) {
            //Actualizar
            $this->actualizar();
        } else {
            //Crear nuevo registro
            $this->crear();
        }
    }

    //Crear un registro
    public function crear()
    {
        //sanitizar la entrada de los datos
        $datos = $this->sanitizarDatos();

        //Insertar en la DB
        $query = "INSERT INTO " .  static::$tabla  . " ( ";
        $query .= join(', ', array_keys($datos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($datos));
        $query .= " ') ";


        $resultado = self::$db->query($query);

        //Mensaje de exito
        if ($resultado) {
            //Redireccionar al usuario
            header('Location: /admin?resultado=1');
        }
    }

    //Actualizar un registro
    public function actualizar()
    {
        //sanitizar la entrada de los datos
        $datos = $this->sanitizarDatos();

        $valores = [];
        foreach ($datos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        if ($resultado) {
            //Redireccionar al usuario
            header('Location: /admin?resultado=2');
        }
        return $resultado;
    }

    //Eliminar un registro
    public function eliminar()
    {
        //Eliminar la propiedad
        $query = "DELETE FROM " . static::$tabla  . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        $this->borrarImagen();

        if ($resultado) {
            header('Location: /admin?resultado=3');
            exit;
        }
    }

    //Identificar y unir datos de la DB
    public function datos()
    {
        $datos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $datos[$columna] = $this->$columna;
        }
        return $datos;
    }

    public function sanitizarDatos()
    {
        $datos = $this->datos();
        $santizado = [];

        foreach ($datos as $key => $value) {
            $santizado[$key] = self::$db->escape_string($value);
        }
        return $santizado;
    }

    // Validacion
    public static function getErrores()
    {
        return static::$errores;
    }

    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }


    public function setImagen($imagen)
    {
        //Elimina imagen previa
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }
        //Asignar al atributo el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Eliminar 
    public function borrarImagen()
    {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if (isset($this->id)) {
            //Comprobar
            if ($existeArchivo) {
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
        }
    }

    //Listar todas los registros
    public static function all()
    {
        $query = 'SELECT * FROM ' . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //obtiene numero de registros
    public static function get($cantidad)
    {
        $query = 'SELECT * FROM ' . static::$tabla . " LIMIT " . $cantidad;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //Busca un registro por su ID
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }


    public static function consultarSQL($query)
    {
        //Consultar DB
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        //liberar memoria
        $resultado->free();

        //retornar los resultados
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

    //Sincroniza el objeto con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
