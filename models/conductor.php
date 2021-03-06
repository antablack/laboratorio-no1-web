<?php 
include_once(realpath(dirname(__FILE__)) . "/connection.php");
class Conductor {
    public $id;
    public $nombres;
    public $apellidos;
    public $direccion;
    public $telefono;
    public $correo;
    public $licencia;
    public $salario;
    public $created;
    public $modified;

    static function count(){
        $str = "SELECT COUNT(id) as total FROM conductores";
        return (Connection::query($str)->fetch_assoc())["total"];
    }

    static function get($id){
        $str = 'SELECT id, nombres, apellidos, direccion, telefono, correo, licencia, salario, created, modified FROM conductores WHERE id='.$id.' LIMIT 1';
        $conductorQuery = Connection::query($str);
        $conductorAssoc = $conductorQuery->fetch_assoc();
        if ($conductorAssoc) {
            $conductor = new Conductor();
            $conductor->id = $conductorAssoc["id"];
            $conductor->nombres = $conductorAssoc["nombres"];
            $conductor->apellidos = $conductorAssoc["apellidos"];
            $conductor->direccion = $conductorAssoc["direccion"];
            $conductor->telefono = $conductorAssoc["telefono"];
            $conductor->correo = $conductorAssoc["correo"];
            $conductor->licencia = $conductorAssoc["licencia"];
            $conductor->salario = $conductorAssoc["salario"];
            $conductor->created = $conductorAssoc["created"];
            $conductor->modified = $conductorAssoc["modified"];
            return $conductor;
        }
        return null;
    }

    static function delete($id){
        $str = "DELETE FROM conductores WHERE id=".$id;
        return Connection::query($str);
    }

    static function listar() {
        $str = 'SELECT id, nombres, apellidos, direccion, telefono, correo, licencia, salario, created, modified  FROM conductores';
        $conductorQuery = Connection::query($str);
        if ($conductorQuery) {
            $conductorList = array();
            while ($conductorItem = $conductorQuery->fetch_assoc()) {
                $conductor = new Conductor();
                $conductor->id = $conductorItem["id"];
                $conductor->nombres = $conductorItem["nombres"];
                $conductor->apellidos = $conductorItem["apellidos"];
                $conductor->direccion = $conductorItem["direccion"];
                $conductor->telefono = $conductorItem["telefono"];
                $conductor->correo = $conductorItem["correo"];
                $conductor->licencia = $conductorItem["licencia"];
                $conductor->salario = $conductorItem["salario"];
                $conductor->created = $conductorItem["created"];
                $conductor->modified = $conductorItem["modified"];
                array_push($conductorList, $conductor);
            }
            return $conductorList;
        }
        return null;
    }

    function crear(){
        $str = '
        INSERT INTO `conductores`
            (`nombres`,
            `apellidos`,
            `direccion`,
            `telefono`,
            `correo`,
            `licencia`,
            `salario`,
            `created`,
            `modified`)
        VALUES
            ("'.$this->nombres.'",
            "'.$this->apellidos.'",
            "'.$this->direccion.'",
            "'.$this->telefono.'",
            "'.$this->correo.'",
            "'.$this->licencia.'",
            '.$this->salario.',
            "'.$this->created.'",
            "'.$this->modified.'");
        ';
        return Connection::query($str);
    }

    function actualizar() {
        $str = '
            UPDATE `conductores`
            SET
            `nombres` = "'.$this->nombres.'",
            `apellidos` = "'.$this->apellidos.'",
            `direccion` = "'.$this->direccion.'",
            `telefono` = "'.$this->telefono.'",
            `correo` = "'.$this->correo.'",
            `licencia` = "'.$this->licencia.'",
            `salario` = '.$this->salario.',
            `modified` = "'.$this->modified.'"
            WHERE `id` = '.$this->id.';
        ';
        return Connection::query($str);
    }
}
