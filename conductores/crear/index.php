<?php 
require("../../controllers/conductor.php"); 
require_once("../../models/conductor.php");

$isEditMode = isset($_GET["id"]) && is_numeric($_GET["id"]);
$id = "";
$conductor = null;
if ($isEditMode) {
    $PAGE_TITLE = 'Transportes | Editar conductores';
    $id = $_GET["id"];
    try {
        $conductor = Conductor::get($id);
    } catch (Error $th) {
        echo $th->getMessage();
        //throw $th;
    }
} else {
    $PAGE_TITLE = 'Transportes | Crear conductores';
    $conductor = new Conductor();
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
                        <h1 class="h3 mb-0 text-gray-800"><?php echo $isEditMode ? "Editar" : "Crear" ?> conductores</h1>
                    </div>

                    <div class="row">

                        <div class="col-md-5">
                            <form class="row needs-validation" method="POST" action="./index.php">
                                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                                <div class="col-md-8 mt-3">
                                    <label for="nombres" class="form-label">Nombres</label>
                                    <input type="text" class="form-control" id="nombres" name="nombres" maxlength="30" value="<?php echo $conductor->nombres; ?>" required>
                                </div>
                                <div class="col-md-8 mt-3">
                                    <label for="apellidos" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos" maxlength="30" value="<?php echo $conductor->apellidos; ?>" required>
                                </div>
                                <div class="col-md-8 mt-3">
                                    <label for="direccion" class="form-label">Direccion</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" maxlength="60" value="<?php echo $conductor->direccion; ?>" required>
                                </div>
                                <div class="col-md-8 mt-3">
                                    <label for="telefono" class="form-label">Telefono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" maxlength="20" value="<?php echo $conductor->telefono; ?>" required>
                                </div>
                                <div class="col-md-8 mt-3">
                                    <label for="correo" class="form-label">Correo</label>
                                    <input type="email" class="form-control" id="correo" name="correo" maxlength="60" value="<?php echo $conductor->correo; ?>" required>
                                </div>
                                <div class="col-md-8 mt-3">
                                    <label for="licencia" class="form-label">Licencia</label>
                                    <input type="text" class="form-control" id="licencia" name="licencia" maxlength="45" value="<?php echo $conductor->licencia; ?>" required>
                                </div>
                                
                                <div class="col-md-8 mt-3">
                                    <label for="salario" class="form-label">Salario</label>
                                    <input type="number" class="form-control" id="salario" name="salario"  value="<?php echo $conductor->salario; ?>" required>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <input type="submit" class="btn btn-primary" name="btnGuardar" value="Guardar">

                                    <?php
                                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btnGuardar"])) {
                                        
                                            if (isset($_POST["id"]) && is_numeric($_POST["id"])) {
                                                ConductorController::actualizar($_POST["id"], $_POST);
                                                echo '
                                                <script>
                                                    window.location = "../";
                                                </script>
                                            ';
                                            } else {
                                                ConductorController::crear($_POST);
                                                echo '
                                            <div class="alert alert-success mt-3 ml-3" role="alert">
                                                Servicio creado exitosamente
                                            </div>
                                            ';
                                            }
                                            try {} catch (Error $th) {
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