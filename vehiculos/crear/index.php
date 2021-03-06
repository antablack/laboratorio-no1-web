<?php
require("../../controllers/vehiculo.php");
require("../../controllers/conductor.php");
require("../../controllers/cliente.php");

$isEditMode = isset($_GET["id"]) && is_numeric($_GET["id"]);
$id = "";
$vehiculo = null;
if ($isEditMode) {
    $PAGE_TITLE = 'Transportes | Editar vehiculos';
    $id = $_GET["id"];
    try {
        $vehiculo = Vehiculo::get($id);
    } catch (Error $th) {
        echo $th->getMessage();
        //throw $th;
    }
} else {
    $PAGE_TITLE = 'Transportes | Crear vehiculos';
    $vehiculo = new Vehiculo();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    $BASE_PATH = '../../';
    include($BASE_PATH . "/__partials/head.php");
    ?>

</head>

<body id="page-top" class="sidebar-toggled">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include($BASE_PATH . "__partials/asideNavBar.php") ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid mt-4">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?php echo $isEditMode ? "Editar" : "Crear" ?> vehiculos</h1>
                    </div>

                    <div class="row">

                        <div class="col-md-5">
                            <form class="row needs-validation" method="POST" action="./index.php">
                                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                <div class="col-md-8 mt-3">
                                    <label for="placa" class="form-label">Placa</label>
                                    <input type="text" class="form-control" id="placa" name="placa" maxlength="10" value="<?php echo $vehiculo->placa; ?>" required>
                                </div>
                                <div class="col-md-8 mt-3">
                                    <label for="modelo" class="form-label">Modelo</label>
                                    <input type="number" class="form-control" id="modelo" name="modelo" maxlength="30" value="<?php echo $vehiculo->modelo; ?>" required>
                                </div>
                                <div class="col-md-8 mt-3">
                                    <label for="marca" class="form-label">Marca</label>
                                    <input type="text" class="form-control" id="marca" name="marca" maxlength="45" value="<?php echo $vehiculo->marca; ?>" required>
                                </div>
                                <div class="col-md-8 mt-3">
                                    <label for="capacidad" class="form-label">Capacidad</label>
                                    <input type="number" class="form-control" id="capacidad" name="capacidad" value="<?php echo $vehiculo->capacidad; ?>" required>
                                </div>

                                <div class="col-md-8 mt-3">
                                    <label for="cliente" class="form-label">Cliente</label>
                                    <select class="form-control" id="cliente" name="cliente" required>
                                        <option <?php echo !$isEditMode ? "selected" : "" ?> disabled value=""></option>
                                        <?php 
                                            $clientes = ClienteController::getAll();
                                            foreach ($clientes as $cliente) {
                                                echo "<option value=".$cliente->id." ". ($cliente->id == $vehiculo->clientes_id ? "selected" : "") ." >".$cliente->nombres." ".$cliente->apellidos."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-8 mt-3">
                                    <label for="conductor" class="form-label">Conductor</label>
                                    <select class="form-control" id="conductor" name="conductor" required>
                                        <option <?php echo !$isEditMode ? "selected" : "" ?> disabled value=""></option>
                                        <?php 
                                            $conductores = ConductorController::getAll();
                                            foreach ($conductores as $conductor) {
                                                echo "<option value=".$conductor->id." ".($conductor->id == $vehiculo->conductores_id ? "selected" : "").">".$conductor->nombres." ".$conductor->apellidos."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <input type="submit" class="btn btn-primary" name="btnGuardar" value="Guardar">

                                    <?php
                                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btnGuardar"])) {

                                        if (isset($_POST["id"]) && is_numeric($_POST["id"])) {
                                            VehiculoController::actualizar($_POST["id"], $_POST);
                                            echo '
                                                <script>
                                                    window.location = "../";
                                                </script>
                                            ';
                                        } else {
                                            VehiculoController::crear($_POST);
                                            echo '
                                            <div class="alert alert-success mt-3 ml-3" role="alert">
                                                Servicio creado exitosamente
                                            </div>
                                            ';
                                        }
                                        try {
                                        } catch (Error $th) {
                                            echo '
                                        <div class="alert alert-danger mt-3 ml-3" role="alert">
                                            ' . $th->getMessage() . '
                                        </div>
                                        ';
                                        }
                                    }
                                    ?>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include($BASE_PATH . "__partials/footer.php") ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>

    <?php
    include($BASE_PATH . "__partials/dependencies.php");
    ?>

    <!-- Page level plugins -->
    <script src="<?php echo $BASE_PATH ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $BASE_PATH ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo $BASE_PATH ?>assets/js/demo/datatables-demo.js"></script>
</body>

</html>