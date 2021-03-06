<?php 

require_once("../../controllers/vehiculo.php");

VehiculoController::delete((int) $_GET["id"]);

header('Location: ../');
exit;
?>
