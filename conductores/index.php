<?php require("../controllers/conductor.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    $PAGE_TITLE = 'Transportes | Conductores';
    $BASE_PATH = '../';
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
                        <h1 class="h3 mb-0 text-gray-800">Conductores</h1>
                        <a href="crear/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus fa-sm text-white-50"></i> Crear</a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <td>Id</td>
                                            <td>Nombres</td>
                                            <td>Apellidos</td>
                                            <td>Direccion</td>
                                            <td>Telefono</td>
                                            <td>Correo</td>
                                            <td>Licencia</td>
                                            <td>Salario</td>
                                            <th>Fecha de creaci??n</th>
                                            <th>Fecha de modificaci??n</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td>Id</td>
                                            <td>Nombres</td>
                                            <td>Apellidos</td>
                                            <td>Direccion</td>
                                            <td>Telefono</td>
                                            <td>Correo</td>
                                            <td>Licencia</td>
                                            <td>Salario</td>
                                            <th>Fecha de creaci??n</th>
                                            <th>Fecha de modificaci??n</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                            $conductores = ConductorController::getAll();
                                            foreach ($conductores as $conductor) {
                                                echo "<tr>
                                                    <td>".$conductor->id."</td>
                                                    <td>".$conductor->nombres."</td>
                                                    <td>".$conductor->apellidos."</td>
                                                    <td>".$conductor->direccion."</td>
                                                    <td>".$conductor->telefono."</td>
                                                    <td>".$conductor->correo."</td>
                                                    <td>".$conductor->licencia."</td>
                                                    <td>".$conductor->salario."</td>
                                                    <td>".$conductor->created."</td>
                                                    <td>".$conductor->modified."</td>
                                                    <td>
                                                        <a class='btn btn-primary' href='editar/index.php?id=" . $conductor->id . "'>Editar</a>
                                                        <a class='btn btn-danger' href='eliminar/index.php?id=" . $conductor->id . "'>Eliminar</a>
                                                    </td>
                                                </tr>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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