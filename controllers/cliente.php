<?php
require(realpath(dirname(__FILE__)) . "/../models/cliente.php");

class ClienteController
{
    static function getAll()
    {
        return Cliente::listar();
    }

}
?>