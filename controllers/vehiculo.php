<?php
require(realpath(dirname(__FILE__)) . "/../models/vehiculo.php");

class VehiculoController
{
    static function getAll()
    {
        return Vehiculo::listar();
    }

    static function delete($id)
    {
        return Vehiculo::delete($id);
    }

    static function crear($data)
    {
        $vehiculo = new Vehiculo();
        $vehiculo->id = $data["id"];
        $vehiculo->placa = $data["placa"];
        $vehiculo->modelo = $data["modelo"];
        $vehiculo->marca = $data["marca"];
        $vehiculo->capacidad = $data["capacidad"];
        $vehiculo->clientes_id = $data["cliente"];
        $vehiculo->conductores_id = $data["conductor"];
        $vehiculo->created = date("Y-m-d H:i:s");
        $vehiculo->modified = date("Y-m-d H:i:s");
        $vehiculo->crear();
    }

    static function actualizar($id, $data)
    {
        $vehiculo = Vehiculo::get((int) $id);
        $vehiculo->id = $data["id"];
        $vehiculo->placa = $data["placa"];
        $vehiculo->modelo = $data["modelo"];
        $vehiculo->marca = $data["marca"];
        $vehiculo->capacidad = $data["capacidad"];
        $vehiculo->clientes_id = $data["cliente"];
        $vehiculo->conductores_id = $data["conductor"];
        $vehiculo->modified = date("Y-m-d H:i:s");
        $vehiculo->actualizar();
    }
}
?>