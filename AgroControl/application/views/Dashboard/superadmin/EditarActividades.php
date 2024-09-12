<?php
  $this->load->view('dashboard/superadmin/layoutsSuperAdmin/header');
?>
  <?php
    $dataSidebar['session']=$session;
    $dataSidebar['OptionSelected']='actividades';
    
    $this->load->view('dashboard/superadmin/layoutsSuperAdmin/sidebar',$dataSidebar);
  ?>

    <?php
      if(isset($camposvacios)){
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
        if (isset($actividad)) {
          ?>
          <div class="d-flex justify-content-center">
            <div class="contenedor py-2 text-center">
                <div class="py-2">
                  <h3>EDITANDO ACTIVIDAD (<b><?=$actividad->id_actividad?></b>)</h3>
                  <h5><?=$actividad->nombre_actividad?></h5>
                </div>
              <form method="post" action="<?=base_url('superadmin/actividades/ActividadesController/ActualizarActividades'); ?>">
                <input type="hidden" name="id_actividad" value="<?=$actividad->id_actividad?>">
                <div class="p-3">
                  <h5><i class="fa-solid fa-list"></i> NOMBRE</h5>
                  <input class="form-control" type="text" name="nombre" value="<?= $actividad->nombre_actividad; ?>"
                    required>
                </div>

                <div class="p-3">
                  <h5><i class="fa-solid fa-circle-info"></i> DESCRIPCION</h5>
                  <textarea class="form-control" name="descripcion" cols="100%" rows="10" required><?=$actividad->descripcion?></textarea>
                </div>

                <div class="p-3">
                  <h5><i class="fa-solid fa-location"></i> UBICACION</h5>
                  <input class="form-control" type="text" name="ubicacion"
                    value="<?php echo $actividad->ubicacion; ?>" required>
                </div>

                <div class="row p-3">
                  <div class="col-md-6">
                    <h5>ESTADO</h5>
                    <select class="form-select" name="estado">
                      <?php if ($actividad): ?>
                        <?php if ($actividad->estado_actividad == "DISPONIBLE"): ?>
                          <option value="DISPONIBLE">DISPONIBLE</option>
                          <option value="NO DISPONIBLE">NO DISPONIBLE</option>
                        <?php elseif ($actividad->estado_actividad == "NO DISPONIBLE"): ?>
                          <option value="NO DISPONIBLE">NO DISPONIBLE</option>
                          <option value="DISPONIBLE">DISPONIBLE</option>
                        <?php endif; ?>
                      <?php endif; ?>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <h5>PRIORIDAD</h5>
                    <select class="form-select" name="prioridad">
                      <?php if ($actividad): ?>
                        <?php if ($actividad->prioridad == "ALTA"): ?>
                          <option value="<?=$actividad->prioridad?>"><?=$actividad->prioridad?></option>
                          <option value="MEDIA">MEDIA</option>
                          <option value="BAJA">BAJA</option>
                        <?php elseif ($actividad->prioridad == "MEDIA"): ?>
                          <option value="<?=$actividad->prioridad?>"><?=$actividad->prioridad?></option>
                          <option value="BAJA">BAJA</option>
                          <option value="ALTA">ALTA</option>
                        <?php elseif ($actividad->prioridad == "BAJA"): ?>
                          <option value="<?=$actividad->prioridad?>"><?=$actividad->prioridad?></option>
                          <option value="MEDIA">MEDIA</option>
                          <option value="ALTA">ALTA</option>
                        <?php endif; ?>
                      <?php endif; ?>
                    </select>
                  </div>
                </div>
                <div class="container d-grid gap-2 py-3">
                  <input type="submit" class="btn btn-success" value="GUARDAR CAMBIOS">
                  <a class="btn btn-dark" href="<?=base_url('superadmin/Dashboard/Actividades')?>">REGRESAR A ACTIVIDADES</a>
                </div>
              </form>
            </div>
          </div>
          <?php
        } elseif (isset($usuario) == null) {
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