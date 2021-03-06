<?php
// mysqli_report(MYSQLI_REPORT_STRICT);

class Connection {
  static private $con;

  public static function getInstance(){
    if (!isset(self::$con)) {
      try {
        self::$con = mysqli_connect("mysql", "root", "root", "transporte");
      } catch (Throwable $th) {
        throw new Error('No Database connection');
      }
    }
    
    return self::$con;
  }

  public static function query($str) {
    //echo $str;
    $query = self::getInstance()->query($str);
    if (!$query) {
      throw new Error("Error al ejecutar el proceso");
    }
    return $query;
  }

}