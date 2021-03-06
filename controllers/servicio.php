<?php
require(realpath(dirname(__FILE__)) . "/../models/servicio.php");

class ServicioController
{
    static function getAll()
    {
        return Servicio::listar();
    }

    static function delete($id)
    {
        return Servicio::delete($id);
    }

    static function crear($data)
    {
        $servicio = new Servicio();
        $servicio->precio = $data["precio"];
        $servicio->descripcion = $data["descripcion"];
        $servicio->created = date("Y-m-d H:i:s");
        $servicio->modified = date("Y-m-d H:i:s");
        $servicio->crear();
    }

    static function actualizar($id, $data)
    {
        $servicio = Servicio::get((int) $id);
        $servicio->precio = $data["precio"];
        $servicio->descripcion = $data["descripcion"];
        $servicio->modified = date("Y-m-d H:i:s");
        $servicio->actualizar();
    }
}
?>