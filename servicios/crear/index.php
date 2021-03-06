<?php 
require("../../controllers/servicio.php"); 
require_once("../../models/servicio.php");

$isEditMode = isset($_GET["id"]) && is_numeric($_GET["id"]);
$id = "";
$servicio = null;
if ($isEditMode) {
    $PAGE_TITLE = 'Transportes | Editar servicios';
    $id = $_GET["id"];
    try {
        $servicio = Servicio::get($id);
    } catch (Error $th) {
        echo $th->getMessage();
        //throw $th;
    }
} else {
    $PAGE_TITLE = 'Transportes | Crear servicios';
    $servicio = new Servicio();
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
                        <h1 class="h3 mb-0 text-gray-800"><?php echo $isEditMode ? "Editar" : "Crear" ?> Servicios</h1>
                    </div>

                    <div class="row">

                        <div class="col-md-5">
                            <form class="row needs-validation" method="POST" action="./index.php">
                                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                                <div class="col-md-4 mt-3">
                                    <label for="precio" class="form-label">Precio</label>
                                    <input type="number" class="form-control" id="precio" name="precio"  value="<?php echo $servicio->precio; ?>" required>
                                </div>
                                <div class="col-md-8 mt-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion" maxlength="50" value="<?php echo $servicio->descripcion; ?>" required>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <input type="submit" class="btn btn-primary" name="btnGuardar" value="Guardar">

                                    <?php
                                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btnGuardar"])) {
                                        try {
                                            if (isset($_POST["id"]) && is_numeric($_POST["id"])) {
                                                ServicioController::actualizar($_POST["id"], $_POST);
                                                echo '
                                                <script>
                                                    window.location = "../";
                                                </script>
                                            ';
                                            } else {
                                                ServicioController::crear($_POST);
                                                echo '
                                            <div class="alert alert-success mt-3 ml-3" role="alert">
                                                Servicio creado exitosamente
                                            </div>
                                            ';
                                            }
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