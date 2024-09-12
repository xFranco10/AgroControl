<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de inicio / AgroControl</title>
    <!-- Estilos de Bootstrap 5 -->
    <link rel="stylesheet" href="http://localhost/AgroControl/assets/dist/css/myStyles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="http://localhost/AgroControl/assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="http://localhost/AgroControl/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/AgroControl/assets/dist/css/adminlte.min.css">
    <link rel="icon" href="http://localhost/AgroControl/assets/dist/img/AdminLTELogo.png">

    <style>


        .footer {
            position:fixed;
            left:0px;
            bottom:0px;
            width:100%;
            background:#999;
        }


    </style>

</head>
<body>
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="http://localhost/AgroControl/assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

    <header id="header" class="bg-dark text-white text-center py-5">
        <div class="container py-3">
            <img src="http://localhost/AgroControl/assets/dist/img/LogotipoAgroControl.png" alt="AdminLTE Logo" class="img-fluid img-circle" style="opacity: .8">
        </div>
        <div class="mt-2">
            <h1><b><i>AgroControl</i></b></h1>
            <p>Sistema gestor dedicado a multiple informacion de tu finca</p>
        </div>
    </header>

    <div class="container py-5">
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="login-box">
                    <div class="card card-outline card-dark">

                        <div class="card-header text-center">
                            <h2 href="#" class="h1"><b>INICIAR SESION</b></h2>
                        </div>

                        <div class="card-body">
                            <p class="login-box-msg">Ingresa tus datos personales</p>
                            <form action="<?=base_url('Login/validarInicioSession')?>" method="POST">
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" required name="email" placeholder="CORREO ELECTRONICO">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" required name="password" placeholder="CONTRASEÑA">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="icheck-primary">
                                            <input type="checkbox" id="remember">
                                            <label for="remember">Recordar Usuario</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-success btn-block">INGRESAR</button>
                                    </div>
                                </div>
                            </form>

                            <!-- <div class="social-auth-links text-center mt-2 mb-3">
                                <a href="#" class="btn btn-block btn-outline-dark">
                                    <i class="fa-brands fa-google"></i> Ingresa con <span><span class="text-primary"> G</span><span class="text-danger">o</span><span class="text-warning">o</span><span class="text-primary">g</span><span class="text-success">l</span><span class="text-danger">e</span></span>
                                </a>
                            </div>
                            <p class="mb-1 text-center">
                                <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">He olvidado mi contraseña :[</a>
                            </p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    <footer class="py-4 bg-dark footer">
        <div class="float-right d-none d-sm-block">
            <b>Derechos Reservados</b> 2024
        </div>
        ENGINNERSOFT
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-key"></i> RECUPERAR CUENTA</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="">
                    <div class="modal-body">  
                        <div class="d-flex justify-content-center mb-4">
                            <div class="contenedor py-2 text-center bg-white">
                                <p class="p-3">Ingresa tu correo/email asociado al sistema para proceder con el siguiente paso en la recuperacion del usuario y cambio de contraseña.</p>
                                <div class="p-3">
                                    <h5><i class="fa-solid fa-envelope"></i> EMAIL</h5>
                                    <input class="form-control" type="email" name="email" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">CERRAR</button>
                        <button type="button" class="btn btn-outline-dark">RECUPERAR CONTRASEÑA</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="http://localhost/AgroControl/assets/plugins/jquery/jquery.min.js"></script>
    <script src="http://localhost/AgroControl/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="http://localhost/AgroControl/assets/dist/js/adminlte.min.js"></script>
</body>
</html>
