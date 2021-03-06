<?php
require(realpath(dirname(__FILE__)) . "/../models/conductor.php");

class ConductorController
{
    static function getAll()
    {
        return Conductor::listar();
    }

    static function delete($id)
    {
        return Conductor::delete($id);
    }

    static function crear($data)
    {
        $conductor = new Conductor();
        $conductor->nombres = $data["nombres"];
        $conductor->apellidos = $data["apellidos"];
        $conductor->direccion = $data["direccion"];
        $conductor->telefono = $data["telefono"];
        $conductor->correo = $data["correo"];
        $conductor->licencia = $data["licencia"];
        $conductor->salario = $data["salario"];
        $conductor->created = date("Y-m-d H:i:s");
        $conductor->modified = date("Y-m-d H:i:s");
        $conductor->crear();
    }

    static function actualizar($id, $data)
    {
        $conductor = Conductor::get((int) $id);
        $conductor->id = $data["id"];
        $conductor->nombres = $data["nombres"];
        $conductor->apellidos = $data["apellidos"];
        $conductor->direccion = $data["direccion"];
        $conductor->telefono = $data["telefono"];
        $conductor->correo = $data["correo"];
        $conductor->licencia = $data["licencia"];
        $conductor->salario = $data["salario"];
        $conductor->modified = date("Y-m-d H:i:s");
        $conductor->actualizar();
    }
}
?>