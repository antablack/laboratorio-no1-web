<?php 
include_once(realpath(dirname(__FILE__)) . "/connection.php");
class Cliente {
    public $id;
    public $nombres;
    public $apellidos;

    static function listar() {
        $str = "SELECT id, nombres, apellidos FROM clientes;";
        $clienteAssoc = Connection::query($str);
        if ($clienteAssoc) {
            $clienteList = array();
            while ($clienteItem = $clienteAssoc->fetch_assoc()) {
                $cliente = new Cliente();
                $cliente->id = $clienteItem["id"];
                $cliente->nombres = $clienteItem["nombres"];
                $cliente->apellidos = $clienteItem["apellidos"];
                array_push($clienteList, $cliente);
            }
            return $clienteList;
        }
        return null;
    }

}
