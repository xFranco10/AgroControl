<?php
  $this->load->view('dashboard/superadmin/layoutsSuperAdmin/header');
?>
  <?php
    $dataSidebar['session']=$session;
    $dataSidebar['OptionSelected']='maquinaria';
    
    $this->load->view('dashboard/superadmin/layoutsSuperAdmin/sidebar',$dataSidebar);
  ?>

    <?php
        if(isset($datorepetido)){
        ?>
            <script>
            Swal.fire({
                title: "ACTUALIZACION INCORRECTA",
                text: "Datos de maquinaria repetidos",
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
        if (isset($maquinaria)) {
          ?>
          <div class="d-flex justify-content-center">
            <div class="contenedor py-2 text-center">
                <div class="py-2">
                  <h3>EDITANDO MAQUINARIA (<b><?=$maquinaria->num_serie?></b>)</h3>
                  <h5><?=$maquinaria->nombre_maquinaria?> <?=$maquinaria->fabricante?></h5>
                </div>
              <form method="post" action="<?=base_url('superadmin/maquinaria/MaquinariaController/ActualizarMaquinaria'); ?>">
                <input type="hidden" name="id_maquinaria" value="<?=$maquinaria->id_maquinaria?>">

                <div class="p-3">
                  <h5><i class="fa-solid fa-hashtag"></i> NUMERO DE SERIE</h5>
                  <input class="form-control" type="text" name="num_serie" value="<?= $maquinaria->num_serie?>"
                    required>
                </div>

                <div class="p-3">
                  <h5><i class="fa-solid fa-tractor"></i> NOMBRE</h5>
                  <input class="form-control" type="text" name="nombre" value="<?= $maquinaria->nombre_maquinaria ?>"
                    required>
                </div>

                <div class="p-3">
                  <h5><i class="fa-solid fa-screwdriver-wrench"></i> FABRICANTE</h5>
                  <input class="form-control" type="text" name="fabricante" value="<?= $maquinaria->fabricante; ?>" required>
                </div>

                <div class="p-3">
                  <h5><i class="fa-solid fa-calendar-days"></i> FECHA DE ADQUISICION</h5>
                  <input class="form-control" type="date" name="fecha_adquisicion"
                    value="<?php echo $maquinaria->fecha_adquisicion; ?>" required>
                </div>

                <div class="p-3">
                  <h5><i class="fa-solid fa-dollar-sign"></i> COSTO DE ADQUISICION</h5>
                  <input class="form-control" type="number" name="costo_adquisicion" value="<?= $maquinaria->costo_adquisicion;?>" required>
                </div>

                <div class="row p-3">
                  <div class="col-md-6">
                    <h5>TIPO MAQUINARIA</h5>
                    <select class="form-select" name="tipo_maquinaria">
                      <?php if ($maquinaria): ?>
                        <?php if ($maquinaria->tipo_maquinaria == "Maquinaria Pesada"): ?>
                            <option value="<?=$maquinaria->tipo_maquinaria?>"><?=$maquinaria->tipo_maquinaria?></option>
                            <option value="Maquinaria Ligera">Maquinaria Ligera</option>
                            <option value="Equipos Manuales">Equipos Manuales</option>
                            <option value="Equipos Automatizados">Equipos Automatizados</option>
                        <?php elseif ($maquinaria->tipo_maquinaria == "Maquinaria Ligera"): ?>
                            <option value="<?=$maquinaria->tipo_maquinaria?>"><?=$maquinaria->tipo_maquinaria?></option>
                            <option value="Maquinaria Pesada">Maquinaria Pesada</option>
                            <option value="Equipos Manuales">Equipos Manuales</option>
                            <option value="Equipos Automatizados">Equipos Automatizados</option>
                        <?php elseif ($maquinaria->tipo_maquinaria == "Equipos Manuales"): ?>
                            <option value="<?=$maquinaria->tipo_maquinaria?>"><?=$maquinaria->tipo_maquinaria?></option>
                            <option value="Maquinaria Pesada">Maquinaria Pesada</option>
                            <option value="Maquinaria Ligera">Maquinaria Ligera</option>
                            <option value="Equipos Automatizados">Equipos Automatizados</option>
                        <?php elseif ($maquinaria->tipo_maquinaria == "Equipos Automatizados"): ?>
                            <option value="<?=$maquinaria->tipo_maquinaria?>"><?=$maquinaria->tipo_maquinaria?></option>
                            <option value="Maquinaria Pesada">Maquinaria Pesada</option>
                            <option value="Maquinaria Ligera">Maquinaria Ligera</option>
                            <option value="Equipos Manuales">Equipos Manuales</option>
                        <?php endif; ?>
                      <?php endif; ?>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <h5>ESTADO</h5>
                    <select class="form-select" name="estado">
                      <?php if ($maquinaria): ?>
                        <?php if ($maquinaria->estado_maquinaria == "ACTIVA"): ?>
                            <option value="<?=$maquinaria->estado_maquinaria?>"><?=$maquinaria->estado_maquinaria?></option>
                            <option value="INACTIVA">INACTIVA</option>
                            <option value="SUSPENDIDA">SUSPENDIDA</option>
                            <option value="MANTENIMIENTO">MANTENIMIENTO</option>
                        <?php elseif ($maquinaria->estado_maquinaria == "INACTIVA"): ?>
                            <option value="<?=$maquinaria->estado_maquinaria?>"><?=$maquinaria->estado_maquinaria?></option>
                            <option value="ACTIVA">ACTIVA</option>
                            <option value="SUSPENDIDA">SUSPENDIDA</option>
                            <option value="MANTENIMIENTO">MANTENIMIENTO</option>
                        <?php elseif ($maquinaria->estado_maquinaria == "SUSPENDIDA"): ?>
                            <option value="<?=$maquinaria->estado_maquinaria?>"><?=$maquinaria->estado_maquinaria?></option>
                            <option value="ACTIVA">ACTIVA</option>
                            <option value="INACTIVA">INACTIVA</option>
                            <option value="MANTENIMIENTO">MANTENIMIENTO</option>
                        <?php elseif ($maquinaria->estado_maquinaria == "MANTENIMIENTO"): ?>
                            <option value="<?=$maquinaria->estado_maquinaria?>"><?=$maquinaria->estado_maquinaria?></option>
                            <option value="ACTIVA">ACTIVA</option>
                            <option value="INACTIVA">INACTIVA</option>
                            <option value="SUSPENDIDA">SUSPENDIDA</option>
                        <?php endif; ?>
                      <?php endif; ?>
                    </select>
                  </div>
                </div>

                <div class="container d-grid gap-2 py-3">
                  <input type="submit" class="btn btn-success" value="GUARDAR CAMBIOS">
                  <a class="btn btn-dark" href="<?=base_url('superadmin/Dashboard/Maquinaria')?>">REGRESAR A MAQUINARIA</a>
                </div>
              </form>
            </div>
          </div>
          <?php
        } elseif (isset($maquinaria) == null) {
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