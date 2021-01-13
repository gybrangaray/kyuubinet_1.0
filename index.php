<?php
        
        session_start();
        require "conexion.php";
        if(!isset($_SESSION['id'])){
            header("Location: login.php");
        }
        $nombre = $_SESSION['nombre'];
        $id = $_SESSION['id'];
        $tipo_usuario = $_SESSION['tipo_usuario'];
         if($tipo_usuario == "administrador"){
            $where = "";
            }else if($tipo_usuario == "ventas"){
            $where = "WHERE id = $id";
            }else if($tipo_usuario = "administracion"){
            $where = "WHERE id = $id";
        }
        $sql = "SELECT * FROM usuarios $where";
        $resultado = $mysqli->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Sistema Kyuubinet</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="shortcut icon" href="https://raw.githubusercontent.com/gybrangaray/login/master/kyuubinetSolo.png" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">
                <img src="https://raw.githubusercontent.com/gybrangaray/login/master/kyuubinetSoloDos.png" width="150" height="30"  alt="Kyuubinet" >
                <img src="https://raw.githubusercontent.com/gybrangaray/login/master/kyuubinetSolo.png" width="40" height="30"  alt="Kyuubinet" class="girar">
            </a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
           
            
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['nombre']; ?> <i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        
                        <a class="dropdown-item" href="logout.php">Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">  
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Principal
                            </a>
                            <?php if($tipo_usuario == "administrador" ) { ?>
                            
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Paginas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Autenticación
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.php">Iniciar sesión</a>
                                            <a class="nav-link" href="register.html">Registrar</a>
                                            <a class="nav-link" href="password.html">Se te olvidó tu contraseña</a>
                                        </nav>
                                    </div>
                                   
                                </nav>
                            </div>
                           
                           
                            <div class="sb-sidenav-menu-heading">Areas</div>
                             <!-- SUBMENU DEL NOC | SUBMENU DEL NOC | SUBMENU DEL NOC -->
                            <a class="nav-link collapsed"  data-toggle="collapse" data-target="#collapseNOC" aria-expanded="false" aria-controls="collapseNOC">
                                <div class="sb-nav-link-icon"><i class="fas fa-laptop"></i></div>
                                NOC
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseNOC" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                    <a class="nav-link collapsed" href="ControlFallasCambios.php">
                                        Control de fallas | Control de cambios
                                    </a>
                                    <a class="nav-link collapsed" href="ordenesAprovisionamiento.php">
                                        Ordenes de aprovisionamiento
                                    </a>
                            </div>

                            <!-- SUBMENU DEL DEPARTAMENTO DE VENAS | SUBMENU DEL DEPARTAMENTO DE VENTAS  -->
                            <a class="nav-link" href="depto_ventas.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-credit-card"></i></div>
                                Departamento de ventas
                            </a>
                            
                            <!-- SUBMENU DEL DEPARTAMENTO DE ADMON | SUBMENU DEL DEPARTAMENTO DE ADMON  -->
                            <a class="nav-link" href="depto_admon.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-calculator" aria-hidden="true"></i></div>
                                Departamento de administración
                            </a>
                            
                                <!-- SUBMENU DEL DEPARTAMENTO DE VENAS CON LOG VENTAS | SUBMENU DEL DEPARTAMENTO DE VENTAS CON LOG VENTAS -->
                            <?php 
                                 } 
                                 else if($tipo_usuario == "ventas"){ ?>
                                    <a class="nav-link collapsed"  data-toggle="collapse" data-target="#collapseVentas" aria-expanded="false" aria-controls="collapseVentas">
                                <div class="sb-nav-link-icon"><i class="fa fa-credit-card"></i></div>
                                Departamento de ventas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseVentas" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                    <a class="nav-link collapsed" href="CatalogoClientes.php">
                                        Catalogo de clientes
                                    </a>
                            </div>
                                <?php 
                                 }
                                 else if($tipo_usuario == "administracion"){ ?>
                                      <a class="nav-link" href="depto_admon.php">
                                          <div class="sb-nav-link-icon"><i class="fas fa-calculator" aria-hidden="true"></i></div>
                                           Departamento de administración
                                     </a>
                                <?php 
                                 }
                             ?>
                        </div>
                    </div>
                    
                    <div class="sb-sidenav-footer">
                        <div class="small">Registrado como:</div>
                        <?php echo $_SESSION['nombre']; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"><?php echo $_SESSION['nombre'];  ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><?php echo $_SESSION['nombre']; ?></li>
                         </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                <?php echo $_SESSION['nombre']; ?>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                            <tr>
                                                <th>Usario</th>
                                                <th>Contraseña</th>
                                                <th>Nombre</th>
                                                <th>Tipo de usuario</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Usario</th>
                                                <th>Contraseña</th>
                                                <th>Nombre</th>
                                                <th>Tipo de usuario</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php 
                                                while($row = $resultado->fetch_assoc() )
                                                {
                                            ?>
                                             <tr id="hoverTables">
                                                <td><?php echo $row['usuario']; ?></td>
                                                <td><?php echo $row['contraseña']; ?></td>
                                                <td><?php echo $row['nombre']; ?></td>
                                                <td><?php echo $row['tipo_usuario']; ?></td>
                                            </tr>
                                            <?php 
                                                } 
                                            ?>
                                           
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <?php if($tipo_usuario == "ventas" || $tipo_usuario == "administrador"){ ?>
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Departamento de ventas</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="depto_ventas.php">Acceso Rápido</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } 
                        if($tipo_usuario == "administracion" || $tipo_usuario == "administrador"){ ?>
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Departamento de administración</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="depto_admon.php">Acceso rápido</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Kyuubinet 2021, CDMX</div>
                            <div>
                                <a href="#">Politicas de privacidad</a>
                                &middot;
                                <a href="#">Terminos &amp; Condiciones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        
    </body>
</html>

