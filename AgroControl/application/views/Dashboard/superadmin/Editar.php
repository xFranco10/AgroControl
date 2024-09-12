<?php
  $this->load->view('dashboard/superadmin/layoutsSuperAdmin/header');
?>
  <?php
    $dataSidebar['session']=$session;
    $dataSidebar['OptionSelected']='usuarios';
    
    $this->load->view('dashboard/superadmin/layoutsSuperAdmin/sidebar',$dataSidebar);
  ?>
  <?php
    if(isset($datorepetido)){
      ?>
        <script>
          Swal.fire({
            title: "ACTUALIZACION INCORRECTA",
            text: "Datos de usuario repetidos",
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
            icon: "warning"
          });
        </script>
      <?php
    }
  ?>

  <div class="content-wrapper">
    <section class="content">
    <?php
      if(isset($usuario)){
        ?>
        <div class="d-flex justify-content-center">
          <div class="contenedor py-2 text-center">
            <div class="py-2">
              <h3>EDITANDO USUARIO (<b><?=$usuario->documento?></b>)</h3>
              <h5><?=$usuario->nombre?> <?=$usuario->apellido?></h5>
            </div>

            <form method="post" action="<?=base_url('superadmin/usuarios/UsersController/ActualizarDatosUsuario'); ?>">
              <input type="hidden" name="id" value="<?=$usuario->id_usuario; ?>">

              <div class="p-3">
                <h5><i class="fa-solid fa-address-card"></i> CEDULA</h5>
                <input class="form-control" type="number" name="cedula" value="<?=$usuario->documento; ?>" required>
              </div>

              <div class="p-3">
                <h5><i class="fa-solid fa-user"></i> NOMBRES</h5>
                <input class="form-control" type="text" name="nombre" value="<?=$usuario->nombre; ?>" required>
              </div>

              <div class="p-3">
                <h5><i class="fa-solid fa-user"></i> APELLIDOS</h5>
                <input class="form-control" type="text" name="apellido" value="<?=$usuario->apellido; ?>" required>
              </div>
              
              <div class="p-3">
                <h5><i class="fa-solid fa-phone"></i> TELEFONO</h5>
                <input class="form-control" type="number" name="telefono" value="<?=$usuario->telefono; ?>" required>
              </div>

              <div class="p-3">
                <h5><i class="fa-solid fa-location"></i> DIRECCION</h5>
                <input class="form-control" type="text" name="direccion" value="<?=$usuario->direccion; ?>" required>
              </div>

              <div class="p-3">
                <h5><i class="fa-solid fa-envelope"></i> EMAIL</h5>
                <input class="form-control" type="email" name="email" value="<?=$usuario->email; ?>" required>
              </div>
  
              <div class="row p-3">
                <h5><i class="fa-solid fa-plus"></i> PERMISOS</h5>
                <div class="col-md-6">
                  <select class="form-select" name="rol">
                    <?php if ($usuario) : ?>
                      <?php
                        if ($usuario->rol=="SUPERADMIN"){
                          ?>
                            <option value="<?=$usuario->rol?>"><?=$usuario->rol?></option>
                            <option value="ADMIN">ADMIN</option>
                            <option value="AGRICULTORES">AGRICULTORES</option>
                            <option value="JARDINEROS">JARDINEROS</option>
                            <option value="OPERADOR MAQUINARIA">OPERADOR MAQUINARIA</option>
                            <option value="GANADEROS">GANADEROS</option>
                            <option value="ASEADOR">ASEADOR</option>
                            <option value="PERSONAL MANTENIMIENTO">PERSONAL MANTENIMIENTO</option>
                            <option value="MECANICO">MECANICO</option>
                          <?php
                        }elseif($usuario->rol=="ADMIN"){
                          ?>
                            <option value="<?=$usuario->rol?>"><?=$usuario->rol?></option>
                            <option value="SUPERADMIN">SUPERADMIN</option>
                            <option value="AGRICULTORES">AGRICULTORES</option>
                            <option value="JARDINEROS">JARDINEROS</option>
                            <option value="OPERADOR MAQUINARIA">OPERADOR MAQUINARIA</option>
                            <option value="GANADEROS">GANADEROS</option>
                            <option value="ASEADOR">ASEADOR</option>
                            <option value="PERSONAL MANTENIMIENTO">PERSONAL MANTENIMIENTO</option>
                            <option value="MECANICO">MECANICO</option>
                          <?php
                        }elseif($usuario->rol=="AGRICULTORES"){
                          ?>
                            <option value="<?=$usuario->rol?>"><?=$usuario->rol?></option>
                            <option value="SUPERADMIN">SUPERADMIN</option>
                            <option value="ADMIN">ADMIN</option>
                            <option value="JARDINEROS">JARDINEROS</option>
                            <option value="OPERADOR MAQUINARIA">OPERADOR MAQUINARIA</option>
                            <option value="GANADEROS">GANADEROS</option>
                            <option value="ASEADOR">ASEADOR</option>
                            <option value="PERSONAL MANTENIMIENTO">PERSONAL MANTENIMIENTO</option>
                            <option value="MECANICO">MECANICO</option>
                          <?php
                        }elseif($usuario->rol=="JARDINEROS"){
                          ?>
                            <option value="<?=$usuario->rol?>"><?=$usuario->rol?></option>
                            <option value="SUPERADMIN">SUPERADMIN</option>
                            <option value="ADMIN">ADMIN</option>
                            <option value="AGRICULTORES">AGRICULTORES</option>
                            <option value="OPERADOR MAQUINARIA">OPERADOR MAQUINARIA</option>
                            <option value="GANADEROS">GANADEROS</option>
                            <option value="ASEADOR">ASEADOR</option>
                            <option value="PERSONAL MANTENIMIENTO">PERSONAL MANTENIMIENTO</option>
                            <option value="MECANICO">MECANICO</option>
                          <?php
                        }elseif($usuario->rol=="OPERADOR MAQUINARIA"){
                          ?>
                            <option value="<?=$usuario->rol?>"><?=$usuario->rol?></option>
                            <option value="SUPERADMIN">SUPERADMIN</option>
                            <option value="ADMIN">ADMIN</option>
                            <option value="AGRICULTORES">AGRICULTORES</option>
                            <option value="JARDINEROS">JARDINEROS</option>
                            <option value="GANADEROS">GANADEROS</option>
                            <option value="ASEADOR">ASEADOR</option>
                            <option value="PERSONAL MANTENIMIENTO">PERSONAL MANTENIMIENTO</option>
                            <option value="MECANICO">MECANICO</option>
                          <?php
                        }elseif($usuario->rol=="GANADEROS"){
                          ?>
                            <option value="<?=$usuario->rol?>"><?=$usuario->rol?></option>
                            <option value="SUPERADMIN">SUPERADMIN</option>
                            <option value="ADMIN">ADMIN</option>
                            <option value="AGRICULTORES">AGRICULTORES</option>
                            <option value="JARDINEROS">JARDINEROS</option>
                            <option value="OPERADOR MAQUINARIA">OPERADOR MAQUINARIA</option>
                            <option value="ASEADOR">ASEADOR</option>
                            <option value="PERSONAL MANTENIMIENTO">PERSONAL MANTENIMIENTO</option>
                            <option value="MECANICO">MECANICO</option>
                          <?php
                        }elseif($usuario->rol=="ASEADOR"){
                          ?>
                            <option value="<?=$usuario->rol?>"><?=$usuario->rol?></option>
                            <option value="SUPERADMIN">SUPERADMIN</option>
                            <option value="ADMIN">ADMIN</option>
                            <option value="AGRICULTORES">AGRICULTORES</option>
                            <option value="JARDINEROS">JARDINEROS</option>
                            <option value="OPERADOR MAQUINARIA">OPERADOR MAQUINARIA</option>
                            <option value="GANADEROS">GANADEROS</option>
                            <option value="PERSONAL MANTENIMIENTO">PERSONAL MANTENIMIENTO</option>
                            <option value="MECANICO">MECANICO</option>
                          <?php
                        }elseif($usuario->rol=="PERSONAL MANTENIMIENTO"){
                          ?>
                            <option value="<?=$usuario->rol?>"><?=$usuario->rol?></option>
                            <option value="SUPERADMIN">SUPERADMIN</option>
                            <option value="ADMIN">ADMIN</option>
                            <option value="AGRICULTORES">AGRICULTORES</option>
                            <option value="JARDINEROS">JARDINEROS</option>
                            <option value="OPERADOR MAQUINARIA">OPERADOR MAQUINARIA</option>
                            <option value="GANADEROS">GANADEROS</option>
                            <option value="ASEADOR">ASEADOR</option>
                            <option value="MECANICO">MECANICO</option>
                          <?php
                        }elseif($usuario->rol=="MECANICO"){
                          ?>
                            <option value="<?=$usuario->rol?>"><?=$usuario->rol?></option>
                            <option value="SUPERADMIN">SUPERADMIN</option>
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
                    <?php endif; ?>
                  </select> 
                </div>
                <div class="col-md-6">
                  <select class="form-select" name="estado">
                    <?php if ($usuario) : ?>
                      <?php
                        if ($usuario->estado=="ACTIVO"){
                          ?>
                            <option value="<?=$usuario->estado?>"><?=$usuario->estado?></option>
                            <option value="INACTIVO">INACTIVO</option>
                          <?php
                        }elseif($usuario->estado=="INACTIVO"){
                          ?>
                            <option value="<?=$usuario->estado?>"><?=$usuario->estado?></option>
                            <option value="ACTIVO">ACTIVO</option>
                          <?php
                        }  
                      ?>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
              <div class="container d-grid gap-2 py-3">
                <input type="submit" class="btn btn-success" value="GUARDAR CAMBIOS">
                <a class="btn btn-dark" href="<?=base_url('superadmin/Dashboard/Usuarios')?>">REGRESAR A USUARIOS</a>
              </div>
            </form>
          </div>
        </div>
        <?php
      }elseif(isset($usuario)==null){
        ?>
          <div class="pt-5">
            <h3 class="text-center py-2">EL ID NO FUE ENCONTRADO</h3>
            <div class="d-flex justify-content-center ">
              <img class="img img-fluid" src="http://localhost/AgroControl/assets/dist/img/search.png" alt="">
            </div>
          </div>
        <?php
      }
    ?>
    </section>
  </div>

  <?php
    $this->load->view('dashboard/superadmin/layoutsSuperAdmin/footer');
  ?>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<script src="http://localhost/AgroControl/assets/plugins/jquery/jquery.min.js"></script>
<script src="http://localhost/AgroControl/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="http://localhost/AgroControl/assets/dist/js/adminlte.min.js"></script>

</body>
</html>
