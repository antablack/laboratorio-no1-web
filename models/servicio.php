<?php 
include_once(realpath(dirname(__FILE__)) . "/connection.php");
class Servicio {
    public $id;
    public $descripcion;
    public $precio;
    public $created;
    public $modified;

    static function count(){
        $str = "SELECT COUNT(id) as total FROM servicios";
        return (Connection::query($str)->fetch_assoc())["total"];
    }

    static function get($id){
        $str = 'SELECT id, descripcion, precio, created, modified FROM servicios WHERE id='.$id.' LIMIT 1';
        $servicioQuery = Connection::query($str);
        $servicioAssoc = $servicioQuery->fetch_assoc();
        if ($servicioAssoc) {
            $servicio = new Servicio();
            $servicio->id = $servicioAssoc["id"];
            $servicio->descripcion = $servicioAssoc["descripcion"];
            $servicio->precio = $servicioAssoc["precio"];
            $servicio->created = $servicioAssoc["created"];
            $servicio->modified = $servicioAssoc["modified"];
            return $servicio;
        }
        return null;
    }

    static function delete($id){
        $str = "DELETE FROM servicios WHERE id=".$id;
        return Connection::query($str);
    }

    static function listar() {
        $str = 'SELECT id, descripcion, precio, created, modified  FROM servicios';
        $servicioQuery = Connection::query($str);
        if ($servicioQuery) {
            $servicioList = array();
            while ($servicioItem = $servicioQuery->fetch_assoc()) {
                $servicio = new Servicio();
                $servicio->id = $servicioItem["id"];
                $servicio->descripcion = $servicioItem["descripcion"];
                $servicio->precio = $servicioItem["precio"];
                $servicio->created = $servicioItem["created"];
                $servicio->modified = $servicioItem["modified"];
                array_push($servicioList, $servicio);
            }
            return $servicioList;
        }
        return null;
    }

    function crear(){
        $str = '
        INSERT INTO `servicios`
            (`descripcion`,
            `precio`,
            `created`,
            `modified`)
        VALUES
            ("'.$this->descripcion.'",
            '.$this->precio.',
            "'.$this->created.'",
            "'.$this->modified.'");
        ';
        return Connection::query($str);
    }

    function actualizar() {
        $str = '
            UPDATE `servicios`
            SET
            `descripcion` = "'.$this->descripcion.'",
            `precio` = '.$this->precio.',
            `modified` = "'.$this->modified.'"
            WHERE `id` = '.$this->id.';
        
        ';
        return Connection::query($str);
    }
}
