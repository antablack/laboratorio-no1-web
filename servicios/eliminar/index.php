<?php 

require_once("../../controllers/servicio.php");

ServicioController::delete((int) $_GET["id"]);

header('Location: ../');
exit;
?>
