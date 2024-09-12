<?php
  $this->load->view('dashboard/superadmin/layoutsSuperAdmin/header');
?>
  <?php
    $dataSidebar['session']= $session;
    $dataSidebar['OptionSelected']='asignaciones';
    
    $this->load->view('dashboard/superadmin/layoutsSuperAdmin/sidebar',$dataSidebar);
  ?>
  <?php
    if(isset($asignacionActualizada)){
      ?>
        <script>
          Swal.fire({
            title: "ASIGNACION MODIFICADA",
            text: "La asignacion fue modificada exitosamente",
            icon: "success"
          });
        </script>
      <?php
    }elseif(isset($camposvacios)){
      ?>
        <script>
          Swal.fire({
            title: "ERROR EN DATOS",
            text: "Hay campos que estan vacios",
            icon: "warning"
          });
        </script>
      <?php
    }elseif(isset($fechaIncorrect)){
      ?>
        <script>
          Swal.fire({
            title: "ERROR DE FECHAS",
            text: "La fecha de inicio debe ser mayor a la fecha final",
            icon: "warning"
          });
        </script>
      <?php
    }
  ?>

  <div class="content-wrapper">

    <section class="content">
        <?php
            if(isset($asignacion)){
                ?>
                <div class="d-flex justify-content-center">
                    <div class="contenedor py-2 text-center">
                        <div class="py-2">
                          <h3>EDITANDO ASIGNACION (<b><?=$asignacion->id_asignacion?></b>)</h3>
                        </div>
                        <form method="post" action="<?php echo base_url('superadmin/asignaciones/AsignacionesController/updateAsignaciones/'.$asignacion->id_asignacion)?>">
                            <input type="hidden" name="id_asignacion" value="<?=$asignacion->id_asignacion?>">
                            <div class="row p-3">

                                <div class="col-md-6">
                                    <select class="form-select" id="id_actividad" name="id_actividad">
                                      <?php
                                        if($asignacion->id_actividad==null){
                                          ?>
                                            <?php foreach ($actividadnull as $actividad): ?>
                                              <option value="<?=$actividad->id_actividad?>"><?=$actividad->nombre_actividad?></option>
                                            <?php endforeach; ?>                                            
                                          <?php
                                        }
                                      ?>
                                        <?php foreach ($ActividadActual as $actividad): ?>
                                            <option value="<?=$actividad->id_actividad?>"><?= $actividad->nombre_actividad ?></option>
                                        <?php endforeach; ?>
                                        <?php foreach ($ActividadDiferente as $actividad): ?>
                                            <option value="<?=$actividad->id_actividad?>"><?= $actividad->nombre_actividad ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-6">
                                    <select class="form-select" name="id_usuario">
                                      <?php
                                        if($asignacion->id_usuario==null){
                                          ?>
                                            <?php foreach ($usuarionull as $usuario): ?>
                                              <option value="<?=$usuario->id_usuario?>"><?=$usuario->nombre?></option>
                                            <?php endforeach; ?>                                            
                                          <?php
                                        }
                                      ?>
                                        <?php foreach ($UsuarioActual as $usuario): ?>
                                            <option value="<?=$usuario->id_usuario?>"><?=$usuario->nombre?> - <?=$usuario->rol?></option>
                                        <?php endforeach; ?>
                                        <?php foreach ($UsuarioDiferente as $usuario): ?>
                                            <option value="<?=$usuario->id_usuario?>"><?=$usuario->nombre?> - <?=$usuario->rol?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                            </div>

                            <div class="row p-3">

                                <div class="col-md-6">
                                    <select class="form-select" name="id_maquinaria">
                                      <?php
                                        if($asignacion->id_maquinaria==null){
                                          ?>
                                            <?php foreach ($maquinarianull as $maquinaria): ?>
                                              <option value="<?=$maquinaria->id_maquinaria?>"><?=$maquinaria->nombre_maquinaria?></option>
                                            <?php endforeach; ?>                                            
                                          <?php
                                        }
                                      ?>
                                      <?php foreach ($MaquinariaActual as $maquinaria): ?>
                                          <option value="<?=$maquinaria->id_maquinaria?>"><?= $maquinaria->nombre_maquinaria?></option>
                                      <?php endforeach; ?>
                                      <?php foreach ($MaquinariaDiferente as $maquinaria): ?>
                                          <option value="<?=$maquinaria->id_maquinaria?>"><?= $maquinaria->nombre_maquinaria?></option>
                                      <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <select class="form-select" name="estado_asignacion">
                                      <?php
                                        if($asignacion->estado_asignacion=="En Progreso"){
                                          ?>
                                            <option value="<?=$asignacion->estado_asignacion?>"><?=$asignacion->estado_asignacion?></option>                                    
                                            <option value="Completada">Completada</option>                                                                              
                                            <option value="Pendiente">Pendiente</option>                                                                              
                                            <option value="Suspendida">Suspendida</option>                                                                              
                                            <option value="Cancelada">Cancelada</option>      
                                            <option value="Atrasada">Atrasada</option>                                                                              
                                          <?php
                                        }elseif($asignacion->estado_asignacion=="Completada"){
                                          ?>
                                            <option value="<?=$asignacion->estado_asignacion?>"><?=$asignacion->estado_asignacion?></option>                                    
                                            <option value="En progreso">En progreso</option>                                                                              
                                            <option value="Pendiente">Pendiente</option>                                                                              
                                            <option value="Suspendida">Suspendida</option>                                                                              
                                            <option value="Cancelada">Cancelada</option>      
                                            <option value="Atrasada">Atrasada</option>                                                                              
                                          <?php
                                        }elseif($asignacion->estado_asignacion=="Pendiente"){
                                          ?>
                                            <option value="<?=$asignacion->estado_asignacion?>"><?=$asignacion->estado_asignacion?></option>                                    
                                            <option value="En progreso">En progreso</option>                                                                              
                                            <option value="Completada">Completada</option>                                                                              
                                            <option value="Suspendida">Suspendida</option>                                                                              
                                            <option value="Cancelada">Cancelada</option>      
                                            <option value="Atrasada">Atrasada</option>                                                                              
                                          <?php
                                        }elseif($asignacion->estado_asignacion=="Suspendida"){
                                          ?>
                                            <option value="<?=$asignacion->estado_asignacion?>"><?=$asignacion->estado_asignacion?></option>                                    
                                            <option value="En progreso">En progreso</option>                                                                              
                                            <option value="Completada">Completada</option>                                                                              
                                            <option value="Pendiente">Pendiente</option>                                                                              
                                            <option value="Cancelada">Cancelada</option>      
                                            <option value="Atrasada">Atrasada</option>                                                                              
                                          <?php
                                        }elseif($asignacion->estado_asignacion=="Cancelada"){
                                          ?>
                                            <option value="<?=$asignacion->estado_asignacion?>"><?=$asignacion->estado_asignacion?></option>                                    
                                            <option value="En progreso">En progreso</option>                                                                              
                                            <option value="Completada">Completada</option>                                                                              
                                            <option value="Pendiente">Pendiente</option>                                                                              
                                            <option value="Suspendida">Suspendida</option>      
                                            <option value="Atrasada">Atrasada</option>                                                                              
                                          <?php
                                        }elseif($asignacion->estado_asignacion=="Atrasada"){
                                          ?>
                                            <option value="<?=$asignacion->estado_asignacion?>"><?=$asignacion->estado_asignacion?></option>                                    
                                            <option value="En progreso">En progreso</option>                                                                              
                                            <option value="Completada">Completada</option>                                                                              
                                            <option value="Pendiente">Pendiente</option>                                                                              
                                            <option value="Suspendida">Suspendida</option>      
                                            <option value="Cancelada">Cancelada</option>                                                                              
                                          <?php
                                        }
                                      ?>
                                    </select>
                                </div>
                            </div>   
                            <div class="row p-3">
                            
                                <div class="col-md-6 mb-3">
                                    <h6><i class="fa-solid fa-calendar-days"></i><b> FECHA INICIO</b></h6>
                                    <input type="date" class="form-control" name="fecha_inicio" required value="<?= $asignacion->fecha_inicio ?>">                                    
                                </div>

                                <div class="col-md-6 mb-3">
                                    <h6><i class="fa-solid fa-calendar-days"></i><b> FECHA FIN</b></h6>
                                    <input type="date" class="form-control"  name="fecha_finalizacion" required value="<?= $asignacion->fecha_finalizacion ?>">
                                </div>
                                
                            </div>
                            
                            <div class="container d-grid gap-2 py-3">
                                <input type="submit" class="btn btn-success" value="GUARDAR CAMBIOS">
                                <a class="btn btn-dark" href="<?=base_url('superadmin/Dashboard/Asignaciones')?>">REGRESAR A ASIGNACIONES</a>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
            }elseif(isset($asignacion)==null){
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
