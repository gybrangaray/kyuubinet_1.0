<?php
    require "conexion.php";
    session_start();
    if($_POST){
        $usuario = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];
        
        $sql = "SELECT id, usuario, contraseña, nombre, tipo_usuario FROM usuarios WHERE usuario='$usuario' ";
      
        $resultado = $mysqli->query($sql);
        $num = $resultado->num_rows;   //si existe envia el registro.
        if($num > 0){
            $row = $resultado->fetch_assoc();
            $contraseña_bd = $row['contraseña'];

            $pass_cif = sha1($contraseña); // cifrar contraseña
            if($contraseña_bd == $pass_cif){
                $_SESSION['id'] = $row['id'];
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['tipo_usuario'] = $row['tipo_usuario'];
                header("Location: index.php");
            }else{
                echo "Error, verificar credenciales";
            }
        }else{
            echo "No existe este usuario";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Ingresar | Kyuubinet</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body >
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">
                                    <img src="https://raw.githubusercontent.com/gybrangaray/login/master/kyuubinetSoloDos.png" width="150" height="30"  alt="Kyuubinet" >
                                      </br>Ingresar</h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress" require>Usuario</label>
                                                <input class="form-control py-4" id="inputEmailAddress" name="usuario" type="text" placeholder="Introducir usuario" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword" require>Contraseña</label>
                                                <input class="form-control py-4" id="inputPassword" name="contraseña" type="password" placeholder="Introducir contraseña" />
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Recordar contraseña</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">¿Olvidaste tu contraseña?</a>
                                                <button class="btn btn-outline-primary" type="submit">Ingresar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.html">Registrarse</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Kyuubinet 2021</div>
                            <div>
                                <a href="#">Politicas de privacodad</a>
                                &middot;
                                <a href="#">Terminos &amp; Conditiciones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
