<?php
  $this->load->view('dashboard/superadmin/layoutsSuperAdmin/header');
?>
  <?php
    $dataSidebar['session']=$session;
    $dataSidebar['OptionSelected']='Perfil';
    
    $this->load->view('dashboard/superadmin/layoutsSuperAdmin/sidebar',$dataSidebar);
  ?>

    <?php
      if (isset($passwordActualizada)) {
        ?>
          <script>
            Swal.fire({
              title: "CONTRASEÑA ACTUALIZADA",
              text: "La Contraseña se actualizo correctamente, por su seguridad se cerrara la sesion actual!",
              icon: "success"
            });
          </script>
          <meta http-equiv="refresh" content="4;url=<?= base_url('Start/cerrarSession')?>">
        <?php
      }elseif(isset($NewPasswordNoCoincide)){
        ?>
          <script>
            Swal.fire({
              title: "NO SE ACTUALIZO",
              text: "La nueva contraseña no coincide con la confirmacion",
              icon: "warning"
            });
          </script>
        <?php
      }elseif(isset($camposvacios)){
        ?>
          <script>
            Swal.fire({
              title: "ERROR EN DATOS",
              text: "Los campos estan vacios",
              icon: "error"
            });
          </script>
        <?php
      }elseif(isset($passwordincorrecta)){
        ?>
          <script>
            Swal.fire({
              title: "CONTRASEÑA INCORRECTA",
              text: "La contraseña ingresada es incorrecta",
              icon: "error"
            });
          </script>
        <?php
      }elseif(isset($perfilactualizado)){
        ?>
          <script>
            Swal.fire({
              title: "ACTUALIZACION CORRECTA",
              text: "Tus datos personales se actualizaron correctamente, por su seguridad se cerrara la sesion actual!",
              icon: "success"
            });
          </script>
          <meta http-equiv="refresh" content="4;url=<?= base_url('Start/cerrarSession')?>">
        <?php
      }elseif(isset($datosrepetidos)){
        ?>
          <script>
            Swal.fire({
              title: "ACTUALIZACION INCORRECTA",
              text: "Datos ingresados ya existen en el sistema, intente nuevamente",
              icon: "warning"
            });
          </script>
        <?php
      }elseif(isset($formatoincorrecto)){
        ?>
          <script>
            Swal.fire({
              title: "ACTUALIZACION INCORRECTA",
              text: "El archivo ingresado no es valido, intente de nuevo",
              icon: "warning"
            });
          </script>
        <?php
      }elseif(isset($ImgProfileActualizada)){
        ?>
          <script>
            Swal.fire({
              title: "ACTUALIZACION CORRECTA",
              text: "La Imagen se actualizo correctamente, por su seguridad se cerrara la sesion actual!",
              icon: "success"
            });
          </script>
          <meta http-equiv="refresh" content="4;url=<?= base_url('Start/cerrarSession')?>">
        <?php
      }
    ?>
  
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <div class="card card-orange card-outline">
              <div class="card-body box-profile">
                <div class="text-center ProfilePic">
                  <button class="btn" data-bs-toggle="modal" data-bs-target="#EditUserImg">
                    <img class="img-fluid img-circle imagePic" src="http://localhost/AgroControl/Uploads/<?=$session['imguser']?>" alt="User profile picture">
                    <div class="overlay d-flex justify-content-center">
                      <div class="container py-2">
                        <div class="text-center">
                          <i class="fa-solid fa-camera fa-3x mb-2"></i>
                          <p class="mb-0">ACTUALIZAR FOTO DE PERFIL</p>
                        </div>
                      </div>
                    </div>
                  </button>
                </div>

                <h3 class="profile-username text-center"><?=$session['nombre']?> <?=$session['apellido']?></h3>
                <p class="text-muted text-center"><?=$session['rol']?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Correo Electronico</b> <a class="float-right"><span class="text-orange"><?=$session['email']?></span></a>
                  </li>
                  <li class="list-group-item">
                    <b>Contraseña</b> <a class="float-right"><span class="text-orange">..............</span></a>
                  </li>
                  <li class="list-group-item">
                    <b>Id De Usuario</b> <a class="float-right"><span class="text-orange"><?=$session['id_usuario']?></span></a>
                  </li>
                </ul>

                <button class="btn bg-orange btn-block" title="CAMBIAR CONTRASEÑA" data-bs-toggle="modal" data-bs-target="#staticBackdropPassword"><i class="fa-solid fa-lock" style="color: #ffffff;"></i></button>
              </div>
            </div>
          </div>
          
          
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills text-end">
                  <li class="nav-item"><a class="nav-link active" href="#Inicio" data-toggle="tab">Inicio</a></li>
                  <li class="nav-item"><a class="nav-link" href="#MisDatos" data-toggle="tab">Mis Datos</a></li>
                  <a href="<?=base_url('Start/cerrarSession')?>" class="btn bg-orange">
                    <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>
                    <span class="text-white">CERRAR SESSION</span>
                  </a>
                </ul>
                <div class="d-flex justify-content-end">
                  
                </div>
              </div>

              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="Inicio">
                    <div id="horaActual"></div>
                    <h4>Bienvenido a tu perfil de <b>AgroControl</b>, gracias por elegir a ENGINNERSOFT como tu desarrollador.</h4>
                    <div class="d-flex justify-content-center py-3">
                      <img class="img-fluid" width="500" height="400" src="http://localhost/AgroControl/assets/dist/img/innovaciondigital.gif" alt="img">
                    </div>

                  </div>

                  <div class="tab-pane" id="MisDatos">
                    <div class="form-group row">
                      <label for="nombre" class="col-sm-2 col-form-label">Nombre(s)</label>
                      <div class="col-sm-10">
                        <h3 class="profile-username text-center"><?=$session['nombre']?></h3>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="apellido" class="col-sm-2 col-form-label">Apellido(s)</label>
                      <div class="col-sm-10">
                        <h3 class="profile-username text-center"><?=$session['apellido']?></h3>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="documento" class="col-sm-2 col-form-label">Documento</label>
                      <div class="col-sm-10">
                        <h3 class="profile-username text-center"><?=$session['documento']?></h3>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                      <div class="col-sm-10">
                        <h3 class="profile-username text-center"><?=$session['direccion']?></h3>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                      <div class="col-sm-10">
                        <h3 class="profile-username text-center"><?=$session['telefono']?></h3>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                      <div class="col-sm-10">
                        <h3 class="profile-username text-center"><span class="text-success"><?=$session['estado']?></span></h3>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="estado" class="col-sm-2 col-form-label">OPCIONES</label>
                        <div class="col-sm-10">
                          <button class="btn btn-primary btn-block" title="EDITAR PERFIL" data-bs-toggle="modal" data-bs-target="#staticBackdropPerfil"><i class="fa-solid fa-pencil"></i></button>
                        </div>
                      </div>             
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php
    $this->load->view('dashboard/superadmin/layoutsSuperAdmin/footer');
  ?>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdropPassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">CAMBIAR CONTRASEÑA</h1>
      </div>

      <form action="<?=base_url('superadmin/usuarios/UsersController/cambiarPassword/' . $session['id_usuario'])?>" method="POST">
        <div class="modal-body">
          <div class="d-flex justify-content-center mb-4">
            <div class="contenedor py-2 text-center bg-white">
                <div class="p-3">
                  <h5><i class="fa-solid fa-lock"></i> INGRESE CONTRASEÑA ACTUAL</h5>
                  <input class="form-control" type="text" name="CurrentPassword" required>
                </div>
                <hr>
                <div class="p-3">
                  <h5>NUEVA CONTRASEÑA</h5>
                  <input class="form-control" type="password" name="nuevaPassword" required>
                </div>
                
                <div class="p-3">
                  <h5>CONFIRMAR CONTRASEÑA</h5>
                  <input class="form-control" type="password" name="confirmarPassword" required>
                </div>
            </div>
          </div>
  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">CERRAR</button>
          <button type="submit" class="btn btn-outline-success">CAMBIAR CONTRASEÑA</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="modal fade" id="EditUserImg" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">ACTUALIZAR FOTO DE PERFIL</h1>
      </div>
      <form action="<?=base_url('superadmin/usuarios/UsersController/cargar_imagen')?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" value="<?=$session['id_usuario']?>" name="id_usuario">
          <input class="form-control" type="file" name="upload"> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">CERRAR</button>
          <button type="submit" class="btn btn-outline-success">ACTUALIZAR</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="staticBackdropPerfil" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">EDITAR PERFIL</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('superadmin/usuarios/UsersController/ActualizarMiPerfil')?>" method="POST">
        <div class="modal-body">

          <div class="d-flex justify-content-center mb-4">
            <div class="contenedor py-2 text-center bg-white">
              <input type="hidden" name="id" value="<?=$session['id_usuario']?>">

              <div class="p-3">
                <h5><i class="fa-solid fa-address-card"></i> CEDULA</h5>
                <input class="form-control" type="number" name="cedula" value="<?=$session['documento']?>" required>
              </div>

              <div class="p-3">
                <h5><i class="fa-solid fa-user"></i> NOMBRES</h5>
                <input class="form-control" type="text" name="nombre" value="<?=$session['nombre']?>" required>
              </div>
              
              <div class="p-3">
                <h5><i class="fa-solid fa-user"></i> APELLIDOS</h5>
                <input class="form-control" type="text" name="apellido" value="<?=$session['apellido']?>" required>
              </div>

              <div class="p-3">
                <h5><i class="fa-solid fa-phone"></i> TELEFONO</h5>
                <input class="form-control" type="number" name="telefono" value="<?=$session['telefono']?>" required>
              </div>

              <div class="p-3">
                <h5><i class="fa-solid fa-location"></i> DIRECCION</h5>
                <input class="form-control" type="text" name="direccion" value="<?=$session['direccion']?>" required>
              </div>

              <div class="p-3">
                <h5><i class="fa-solid fa-envelope"></i> EMAIL</h5>
                <input class="form-control" type="email" name="email" value="<?=$session['email']?>" required>
              </div>
  
              <div class="row p-3">
                <h5><i class="fa-solid fa-plus"></i> PERMISOS</h5>
                <div class="col-md-6">
                  <select class="form-control" name="rol">
                      <?php
                        if ($session['rol']=="SUPERADMIN"){
                          ?>
                            <option value="<?=$session['rol']?>"><?=$session['rol']?></option>
                            <option value="ADMIN">ADMIN</option>
                            <option value="AGRICULTORES">AGRICULTORES</option>
                            <option value="JARDINEROS">JARDINEROS</option>
                            <option value="OPERADOR MAQUINARIA">OPERADOR MAQUINARIA</option>
                            <option value="GANADEROS">GANADEROS</option>
                            <option value="ASEADOR">ASEADOR</option>
                            <option value="PERSONAL MANTENIMIENTO">PERSONAL MANTENIMIENTO</option>
                          <?php
                        }
                      ?>
                  </select> 
                </div>
                <div class="col-md-6">
                  <select class="form-control" name="estado">
                      <?php
                        if ($session['estado']=="ACTIVO"){
                          ?>
                            <option value="<?=$session['estado']?>"><?=$session['estado']?></option>
                            <option value="INACTIVO">INACTIVO</option>
                          <?php
                        }
                      ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">CERRAR</button>
          <button type="submit" class="btn btn-outline-success">ACTUALIZAR DATOS</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="http://localhost/AgroControl/assets/dist/js/script.js"></script>
<script src="http://localhost/AgroControl/assets/plugins/jquery/jquery.min.js"></script>
<script src="http://localhost/AgroControl/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="http://localhost/AgroControl/assets/dist/js/adminlte.min.js"></script>

</body>
</html>
