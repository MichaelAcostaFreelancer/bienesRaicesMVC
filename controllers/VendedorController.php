<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use Model\Vendedores;



class VendedorController
{

    public static function crear(Router $router)
    {
        $vendedor = new Vendedores();
        $vendedores = Vendedores::all();
        $errores = Vendedores::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Crear nueva instacian

            $vendedor = new Vendedores($_POST['vendedor']);

            //Validar que no haya campos vacios
            $errores = $vendedor->validar();

            //No hay errores
            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {

        $id = validarORedireccionar('/admin');
        //Obtener el arreglo de vnededor de la db
        $vendedor = Vendedores::find($id);

        //Arreglo para mensaje de errores
        $errores = Vendedores::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Asignar los valores
            $args = $_POST['vendedor'];

            //Sincronizar objeto en memoria con lo que el usuario escribio
            $vendedor->sincronizar($args);

            //Validar
            $errores = $vendedor->validar();

            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Validar Id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {

                $tipo = $_POST['tipo'];

                if (validarContenido($tipo)) {
                    $vendedor = Vendedores::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}
