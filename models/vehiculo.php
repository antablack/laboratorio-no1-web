<?php 
include_once(realpath(dirname(__FILE__)) . "/connection.php");
require(realpath(dirname(__FILE__))."/../lib/tfpdf/tfpdf.php");
class Vehiculo {
    public $id;
    public $placa;
    public $modelo;
    public $marca;
    public $capacidad;
    public $clientes_id;
    public $nombres_clientes;
    public $conductores_id;
    public $nombres_conductores;
    public $created;
    public $modified;

    static function count(){
        $str = "SELECT COUNT(id) as total FROM vehiculos";
        return (Connection::query($str)->fetch_assoc())["total"];
    }

    static function get($id){
        $str = "SELECT v.id, v.placa, v.modelo, v.marca, v.capacidad, v.clientes_id, CONCAT(c.nombres, ' ', c.apellidos) AS nombres_clientes, v.conductores_id, CONCAT(ci.nombres, ' ', ci.apellidos) AS nombres_conductores, v.created, v.modified FROM vehiculos as v INNER JOIN conductores AS c ON v.conductores_id = c.id INNER JOIN clientes AS ci ON v.clientes_id = ci.id WHERE v.id=".$id." LIMIT 1";
        $vehiculoQuery = Connection::query($str);
        $vehiculoAssoc = $vehiculoQuery->fetch_assoc();
        if ($vehiculoAssoc) {
            $vehiculo = new Vehiculo();
            $vehiculo->id = $vehiculoAssoc["id"];
            $vehiculo->placa = $vehiculoAssoc["placa"];
            $vehiculo->modelo = $vehiculoAssoc["modelo"];
            $vehiculo->marca = $vehiculoAssoc["marca"];
            $vehiculo->capacidad = $vehiculoAssoc["capacidad"];
            $vehiculo->clientes_id = $vehiculoAssoc["clientes_id"];
            $vehiculo->nombres_clientes = $vehiculoAssoc["nombres_clientes"];
            $vehiculo->conductores_id = $vehiculoAssoc["conductores_id"];
            $vehiculo->nombres_conductores = $vehiculoAssoc["nombres_conductores"];
            $vehiculo->created = $vehiculoAssoc["created"];
            $vehiculo->modified = $vehiculoAssoc["modified"];
            return $vehiculo;
        }
        return null;
    }

    static function delete($id){
        $str = "DELETE FROM vehiculos WHERE id=".$id;
        return Connection::query($str);
    }


    static function pdf() {
        $pdf = new tFPDF();
        $pdf->SetFont('Arial','B',15);
        $pdf->AddPage();
        $pdf->Text(75, 10, "Listado de vehiculos");
        $pdf->SetY(20);


        $pdf->SetFont('Arial','',10);
        $pdf->Cell(8, 6, 'Id', 1);
        $pdf->Cell(15, 6, 'Placa', 1);
        $pdf->Cell(15, 6, 'Modelo', 1);
        $pdf->Cell(15, 6, 'Marca', 1);
        $pdf->Cell(20, 6, 'Capacidad', 1);
        $pdf->Cell(40, 6, 'Cliente', 1);
        $pdf->Cell(40, 6, 'Conductor', 1);
        $pdf->Cell(40, 6, 'Fecha de creacion', 1);
        $pdf->Ln();

        $vehiculos = Vehiculo::listar();
        foreach ($vehiculos as $vehiculo) {
            $pdf->Cell(8, 6, $vehiculo->id, 1, 'LR');
            $pdf->Cell(15, 6, $vehiculo->placa, 1,'LR');
            $pdf->Cell(15, 6, $vehiculo->modelo, 1,'LR');
            $pdf->Cell(15, 6, $vehiculo->marca, 1,'LR');
            $pdf->Cell(20, 6, $vehiculo->capacidad, 1,'LR');
            $pdf->Cell(40, 6, $vehiculo->nombres_clientes, 1,'LR');
            $pdf->Cell(40, 6, $vehiculo->nombres_conductores, 1,'LR');
            $pdf->Cell(40, 6, $vehiculo->created, 1,'LR');
            $pdf->Ln();
        }

        $pdf->Output();
    }

    static function listar() {
        $str = "SELECT v.id, v.placa, v.modelo, v.marca, v.capacidad, v.clientes_id, CONCAT(c.nombres, ' ', c.apellidos) AS nombres_clientes, v.conductores_id, CONCAT(ci.nombres, ' ', ci.apellidos) AS nombres_conductores, v.created, v.modified FROM vehiculos as v INNER JOIN conductores AS c ON v.conductores_id = c.id INNER JOIN clientes AS ci ON v.clientes_id = ci.id";
        $vehiculoAssoc = Connection::query($str);
        if ($vehiculoAssoc) {
            $vehiculoList = array();
            while ($vehiculoItem = $vehiculoAssoc->fetch_assoc()) {
                $vehiculo = new Vehiculo();
                $vehiculo->id = $vehiculoItem["id"];
                $vehiculo->placa = $vehiculoItem["placa"];
                $vehiculo->modelo = $vehiculoItem["modelo"];
                $vehiculo->marca = $vehiculoItem["marca"];
                $vehiculo->capacidad = $vehiculoItem["capacidad"];
                $vehiculo->clientes_id = $vehiculoItem["clientes_id"];
                $vehiculo->nombres_clientes = $vehiculoItem["nombres_clientes"];
                $vehiculo->conductores_id = $vehiculoItem["conductores_id"];
                $vehiculo->nombres_conductores = $vehiculoItem["nombres_conductores"];
                $vehiculo->created = $vehiculoItem["created"];
                $vehiculo->modified = $vehiculoItem["modified"];
                array_push($vehiculoList, $vehiculo);
            }
            return $vehiculoList;
        }
        return null;
    }

    function crear(){
        $str = '
        INSERT INTO `vehiculos`
            (`placa`,
            `modelo`,
            `marca`,
            `capacidad`,
            `clientes_id`,
            `conductores_id`,
            `created`,
            `modified`)
        VALUES
            ("'.$this->placa.'",
            "'.$this->modelo.'",
            "'.$this->marca.'",
            '.$this->capacidad.',
            '.$this->clientes_id.',
            '.$this->conductores_id.',
            "'.$this->created.'",
            "'.$this->modified.'");
        ';
        return Connection::query($str);
    }


    function actualizar() {
        $str = '
            UPDATE `vehiculos`
            SET
            `placa` = "'.$this->placa.'",
            `modelo` = "'.$this->modelo.'",
            `marca` = "'.$this->marca.'",
            `capacidad` = '.$this->capacidad.',
            `clientes_id` = '.$this->clientes_id.',
            `conductores_id` = '.$this->conductores_id.',
            `modified` = "'.$this->modified.'"
            WHERE `id` = '.$this->id.';
        ';
        return Connection::query($str);
    }
}
