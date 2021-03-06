<?php 

require_once("../../controllers/conductor.php");

ConductorController::delete((int) $_GET["id"]);

header('Location: ../');
exit;
?>
