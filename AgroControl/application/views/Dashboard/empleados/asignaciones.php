<?php
$dataHeader['session'] = $session;
$this->load->view('dashboard/empleados/layoutsEmpleados/header', $dataHeader);

?>
<?php
$dataSidebar['session'] = $session;
$dataSidebar['OptionSelected'] = 'asignaciones';

$this->load->view('dashboard/empleados/layoutsEmpleados/sidebar', $dataSidebar);
?>
<?php
if (isset($usuarioinsertado)) {
  ?>
  <script>
    Swal.fire({
      title: "REGISTRO EXITOSO",
      text: "El usuario se ha registrado correctamente",
      icon: "success"
    });
  </script>
  <meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Usuarios') ?>">
  <?php
} elseif (isset($datorepetido)) {
  ?>
  <script>
    Swal.fire({
      title: "REGISTRO FALLIDO",
      text: "Datos ingresados del usuario ya existen",
      icon: "error"
    });
  </script>
  <meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Usuarios') ?>">
  <?php
} elseif (isset($camposvacios)) {
  ?>
  <script>
    Swal.fire({
      title: "ERROR EN DATOS",
      text: "Los campos estan vacios",
      icon: "warning"
    });
  </script>
  <meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Usuarios') ?>">
  <?php
} elseif (isset($usuarioactualizado)) {
  ?>
  <script>
    Swal.fire({
      title: "ACTUALIZACION EXITOSA",
      text: "El usuario fue actualizado exitosamente",
      icon: "success"
    });
  </script>
  <meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Usuarios') ?>">
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
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills text-end">
            <li class="nav-item"><a class="nav-link active" href="#AllAsignations" data-toggle="tab">ASIGNACIONES</a></li>
            <li class="nav-item"><a class="nav-link" href="#AsignacionesPendientes" data-toggle="tab">PENDIENTES</a></li>
            <li class="nav-item"><a class="nav-link" href="#AsignacionesEnProgreso" data-toggle="tab">EN PROGRESO</a></li>
            <li class="nav-item"><a class="nav-link" href="#AsignacionesAtrasadas" data-toggle="tab">ATRASADAS</a></li>
            <li class="nav-item"><a class="nav-link" href="#AsignacionesCompletadas" data-toggle="tab">COMPLETADAS</a></li>
            <li class="nav-item"><a class="nav-link" href="#AsignacionesSuspendidas" data-toggle="tab">SUSPENDIDAS</a></li>
            <li class="nav-item"><a class="nav-link" href="#AsignacionesCanceladas" data-toggle="tab">CANCELADAS</a></li>
          </ul>
        </div>

        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="AllAsignations">
              <?php foreach ($contadorTotalAsignaciones as $asignacion) { ?>
                <h3>TODAS LAS ASIGNACIONES: <?=$asignacion->total_asignaciones?></h3>
              <?php } ?>
              <div class="row">
                <?php foreach ($asignacionesTotales as $asignacion) { ?>
                  <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                      <div class="card-header text-muted border-bottom-0">
                        Asignacion: <span class="text-end"><?= $asignacion->id_asignacion ?></span>
                      </div>
                      <div class="card-body pt-0">
                        <div class="row">
                          <div class="col-12">
                            <h2 class="lead"><b>
                                <?= $asignacion->nombre_actividad ?>
                              </b></h2>
                            <p class="text-muted text-sm"><b>Informacion: </b></p>
                            <h2 class="lead"><b>
                                <?= $asignacion->descripcion ?>
                              </b></h2>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-location"></i></span>
                                UBICACION - <?= $asignacion->ubicacion ?>
                              </li>
                              <?php
                                if($asignacion->prioridad == "BAJA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-success"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }elseif($asignacion->prioridad == "MEDIA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-warning"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }elseif($asignacion->prioridad == "ALTA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-danger"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }
                              ?>
                              
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-calendar-days"></i></span>
                                FECHA INICIO - <?= $asignacion->fecha_inicio ?>
                              </li>
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-calendar-days"></i></span>
                                FECHA FIN - <?= $asignacion->fecha_finalizacion ?>
                              </li>
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-tractor"></i></span>
                                MAQUINARIA - <?=$asignacion->nombre_maquinaria?>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="text-right">
                          <?php
                            if($session['rol']=="MECANICO"){
                              ?>
                                <form method="POST" action="<?=base_url('empleados/asignaciones/AsignacionesController/AsignacionMantenimiento/')?>">
                                  <input required type="hidden" name="id_asignacion" value="<?=$asignacion->id_asignacion?>">
                                  <input required type="hidden" name="estado_asignacion" value="<?=$asignacion->estado_asignacion?>">
                                  <input required type="hidden" name="id_maquinaria" value="<?=$asignacion->id_maquinaria?>">                                  
                                  <?php
                                    if($asignacion->estado_asignacion == "Completada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-circle-check"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }elseif($asignacion->estado_asignacion == "Pendiente"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-arrow-right"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "En progreso"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-person-digging"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Atrasada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-clock"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Cancelada"){
                                      ?>
                                        <button disabled type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-xmark"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Suspendida"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-circle-exclamation"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }
                                  ?>
                                </form> 
                              <?php
                            }else{
                              ?>
                                <form method="POST" action="<?=base_url('empleados/asignaciones/AsignacionesController/CambiarEstadoAsignacion/')?>">
                                  <input required type="hidden" name="id_asignacion" value="<?=$asignacion->id_asignacion?>">
                                  <input required type="hidden" name="estado_asignacion" value="<?=$asignacion->estado_asignacion?>">
                                  <?php
                                    if($asignacion->estado_asignacion == "Completada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-circle-check"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }elseif($asignacion->estado_asignacion == "Pendiente"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-arrow-right"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "En progreso"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-person-digging"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Atrasada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-clock"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Cancelada"){
                                      ?>
                                        <button disabled type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-xmark"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Suspendida"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-circle-exclamation"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }
                                  ?>
                                </form>
                              <?php
                            }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>

            <div class="tab-pane" id="AsignacionesPendientes">
              <?php foreach ($contadorAsignacionesPendientes as $asignacion) { ?>
                <h3>ASIGNACIONES PENDIENTES: <?=$asignacion->total_asignaciones?></h3>
              <?php } ?>
              <div class="row">
                <?php foreach ($asignacionesPendientes as $asignacion) { ?>
                  <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                      <div class="card-header text-muted border-bottom-0">
                        <?= $asignacion->id_asignacion ?>
                      </div>
                      <div class="card-body pt-0">
                        <div class="row">
                          <div class="col-12">
                            <h2 class="lead"><b>
                                <?= $asignacion->nombre_actividad ?>
                              </b></h2>
                            <p class="text-muted text-sm"><b>Informacion: </b></p>
                            <h2 class="lead"><b>
                                <?= $asignacion->descripcion ?>
                              </b></h2>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-location"></i></span>
                                UBICACION - <?= $asignacion->ubicacion ?>
                              </li>
                              <?php
                                if($asignacion->prioridad == "BAJA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-success"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }elseif($asignacion->prioridad == "MEDIA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-warning"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }elseif($asignacion->prioridad == "ALTA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-danger"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }
                              ?>
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-calendar-days"></i></span>
                                FECHA INICIO - <?= $asignacion->fecha_inicio ?>
                              </li>
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-calendar-days"></i></span>
                                FECHA FIN - <?= $asignacion->fecha_finalizacion ?>
                              </li>
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-tractor"></i></span>
                                MAQUINARIA - <?=$asignacion->nombre_maquinaria?>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                      <div class="text-right">
                          <?php
                            if($session['rol']=="MECANICO"){
                              ?>
                                <form method="POST" action="<?=base_url('empleados/asignaciones/AsignacionesController/AsignacionMantenimiento/')?>">
                                  <input required type="hidden" name="id_asignacion" value="<?=$asignacion->id_asignacion?>">
                                  <input required type="hidden" name="estado_asignacion" value="<?=$asignacion->estado_asignacion?>">
                                  <input required type="hidden" name="id_maquinaria" value="<?=$asignacion->id_maquinaria?>">                                                                    
                                  <?php
                                    if($asignacion->estado_asignacion == "Completada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-circle-check"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }elseif($asignacion->estado_asignacion == "Pendiente"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-arrow-right"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "En progreso"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-person-digging"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Atrasada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-clock"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Cancelada"){
                                      ?>
                                        <button disabled type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-xmark"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Suspendida"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-circle-exclamation"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }
                                  ?>
                                </form> 
                              <?php
                            }else{
                              ?>
                                <form method="POST" action="<?=base_url('empleados/asignaciones/AsignacionesController/CambiarEstadoAsignacion/')?>">
                                  <input required type="hidden" name="id_asignacion" value="<?=$asignacion->id_asignacion?>">
                                  <input required type="hidden" name="estado_asignacion" value="<?=$asignacion->estado_asignacion?>">
                                  <?php
                                    if($asignacion->estado_asignacion == "Completada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-circle-check"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }elseif($asignacion->estado_asignacion == "Pendiente"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-arrow-right"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "En progreso"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-person-digging"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Atrasada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-clock"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Cancelada"){
                                      ?>
                                        <button disabled type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-xmark"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Suspendida"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-circle-exclamation"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }
                                  ?>
                                </form>
                              <?php
                            }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>

            <div class="tab-pane" id="AsignacionesEnProgreso">
              <?php foreach ($contadorAsignacionesProgreso as $asignacion) { ?>
                <h3>ASIGNACIONES EN PROGRESO: <?=$asignacion->total_asignaciones?></h3>
              <?php } ?>
              <div class="row">
                <?php foreach ($asignacionesEnProgreso as $asignacion) { ?>
                  <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                      <div class="card-header text-muted border-bottom-0">
                        <?= $asignacion->id_asignacion ?>
                      </div>
                      <div class="card-body pt-0">
                        <div class="row">
                          <div class="col-12">
                            <h2 class="lead"><b>
                                <?= $asignacion->nombre_actividad ?>
                              </b></h2>
                            <p class="text-muted text-sm"><b>Informacion: </b></p>
                            <h2 class="lead"><b>
                                <?= $asignacion->descripcion ?>
                              </b></h2>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-location"></i></span>
                                UBICACION - <?= $asignacion->ubicacion ?>
                              </li>
                              <?php
                                if($asignacion->prioridad == "BAJA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-success"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }elseif($asignacion->prioridad == "MEDIA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-warning"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }elseif($asignacion->prioridad == "ALTA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-danger"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }
                              ?>
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-calendar-days"></i></span>
                                FECHA INICIO - <?= $asignacion->fecha_inicio ?>
                              </li>
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-calendar-days"></i></span>
                                FECHA FIN - <?= $asignacion->fecha_finalizacion ?>
                              </li>
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-tractor"></i></span>
                                MAQUINARIA - <?=$asignacion->nombre_maquinaria?>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                      <div class="text-right">
                          <?php
                            if($session['rol']=="MECANICO"){
                              ?>
                                <form method="POST" action="<?=base_url('empleados/asignaciones/AsignacionesController/AsignacionMantenimiento/')?>">
                                  <input required type="hidden" name="id_asignacion" value="<?=$asignacion->id_asignacion?>">
                                  <input required type="hidden" name="estado_asignacion" value="<?=$asignacion->estado_asignacion?>">
                                  <input required type="hidden" name="id_maquinaria" value="<?=$asignacion->id_maquinaria?>">                                                                    
                                  <?php
                                    if($asignacion->estado_asignacion == "Completada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-circle-check"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }elseif($asignacion->estado_asignacion == "Pendiente"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-arrow-right"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "En progreso"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-person-digging"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Atrasada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-clock"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Cancelada"){
                                      ?>
                                        <button disabled type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-xmark"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Suspendida"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-circle-exclamation"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }
                                  ?>
                                </form> 
                              <?php
                            }else{
                              ?>
                                <form method="POST" action="<?=base_url('empleados/asignaciones/AsignacionesController/CambiarEstadoAsignacion/')?>">
                                  <input required type="hidden" name="id_asignacion" value="<?=$asignacion->id_asignacion?>">
                                  <input required type="hidden" name="estado_asignacion" value="<?=$asignacion->estado_asignacion?>">
                                  <?php
                                    if($asignacion->estado_asignacion == "Completada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-circle-check"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }elseif($asignacion->estado_asignacion == "Pendiente"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-arrow-right"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "En progreso"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-person-digging"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Atrasada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-clock"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Cancelada"){
                                      ?>
                                        <button disabled type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-xmark"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Suspendida"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-circle-exclamation"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }
                                  ?>
                                </form>
                              <?php
                            }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>

            <div class="tab-pane" id="AsignacionesCompletadas">
              <?php foreach ($contadorAsignacionesCompletadas as $asignacion) { ?>
                <h3>ASIGNACIONES COMPLETADAS: <?=$asignacion->total_asignaciones?></h3>
              <?php } ?>
              <div class="row">
                <?php foreach ($asignacionesCompletadas as $asignacion) { ?>
                  <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                      <div class="card-header text-muted border-bottom-0">
                        <?= $asignacion->id_asignacion ?>
                      </div>
                      <div class="card-body pt-0">
                        <div class="row">
                          <div class="col-12">
                            <h2 class="lead"><b>
                                <?= $asignacion->nombre_actividad ?>
                              </b></h2>
                            <p class="text-muted text-sm"><b>Informacion: </b></p>
                            <h2 class="lead"><b>
                                <?= $asignacion->descripcion ?>
                              </b></h2>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-location"></i></span>
                                UBICACION - <?= $asignacion->ubicacion ?>
                              </li>
                              <?php
                                if($asignacion->prioridad == "BAJA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-success"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }elseif($asignacion->prioridad == "MEDIA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-warning"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }elseif($asignacion->prioridad == "ALTA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-danger"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }
                              ?>
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-calendar-days"></i></span>
                                FECHA INICIO - <?= $asignacion->fecha_inicio ?>
                              </li>
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-calendar-days"></i></span>
                                FECHA FIN - <?= $asignacion->fecha_finalizacion ?>
                              </li>
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-tractor"></i></span>
                                MAQUINARIA - <?=$asignacion->nombre_maquinaria?>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="text-right">
                          <?php
                            if($session['rol']=="MECANICO"){
                              ?>
                                <form method="POST" action="<?=base_url('empleados/asignaciones/AsignacionesController/AsignacionMantenimiento/')?>">
                                  <input required type="hidden" name="id_asignacion" value="<?=$asignacion->id_asignacion?>">
                                  <input required type="hidden" name="estado_asignacion" value="<?=$asignacion->estado_asignacion?>">
                                  <input required type="hidden" name="id_maquinaria" value="<?=$asignacion->id_maquinaria?>">                                                                    
                                  <?php
                                    if($asignacion->estado_asignacion == "Completada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-circle-check"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }elseif($asignacion->estado_asignacion == "Pendiente"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-arrow-right"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "En progreso"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-person-digging"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Atrasada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-clock"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Cancelada"){
                                      ?>
                                        <button disabled type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-xmark"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Suspendida"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-circle-exclamation"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }
                                  ?>
                                </form> 
                              <?php
                            }else{
                              ?>
                                <form method="POST" action="<?=base_url('empleados/asignaciones/AsignacionesController/CambiarEstadoAsignacion/')?>">
                                  <input required type="hidden" name="id_asignacion" value="<?=$asignacion->id_asignacion?>">
                                  <input required type="hidden" name="estado_asignacion" value="<?=$asignacion->estado_asignacion?>">
                                  <?php
                                    if($asignacion->estado_asignacion == "Completada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-circle-check"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }elseif($asignacion->estado_asignacion == "Pendiente"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-arrow-right"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "En progreso"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-person-digging"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Atrasada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-clock"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Cancelada"){
                                      ?>
                                        <button disabled type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-xmark"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Suspendida"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-circle-exclamation"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }
                                  ?>
                                </form>
                              <?php
                            }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>

            <div class="tab-pane" id="AsignacionesAtrasadas">
              <?php foreach ($contadorAsignacionesAtrasadas as $asignacion) { ?>
                <h3>ASIGNACIONES ATRASADAS: <?=$asignacion->total_asignaciones?></h3>
              <?php } ?>
              <div class="row">
                <?php foreach ($asignacionesAtrasadas as $asignacion) { ?>
                  <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                      <div class="card-header text-muted border-bottom-0">
                        <?= $asignacion->id_asignacion ?>
                      </div>
                      <div class="card-body pt-0">
                        <div class="row">
                          <div class="col-12">
                            <h2 class="lead"><b>
                                <?= $asignacion->nombre_actividad ?>
                              </b></h2>
                            <p class="text-muted text-sm"><b>Informacion: </b></p>
                            <h2 class="lead"><b>
                                <?= $asignacion->descripcion ?>
                              </b></h2>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-location"></i></span>
                                UBICACION - <?= $asignacion->ubicacion ?>
                              </li>
                              <?php
                                if($asignacion->prioridad == "BAJA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-success"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }elseif($asignacion->prioridad == "MEDIA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-warning"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }elseif($asignacion->prioridad == "ALTA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-danger"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }
                              ?>
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-calendar-days"></i></span>
                                FECHA INICIO - <?= $asignacion->fecha_inicio ?>
                              </li>
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-calendar-days"></i></span>
                                FECHA FIN - <?= $asignacion->fecha_finalizacion ?>
                              </li>
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-tractor"></i></span>
                                MAQUINARIA - <?=$asignacion->nombre_maquinaria?>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="text-right">
                          <?php
                            if($session['rol']=="MECANICO"){
                              ?>
                                <form method="POST" action="<?=base_url('empleados/asignaciones/AsignacionesController/AsignacionMantenimiento/')?>">
                                  <input required type="hidden" name="id_asignacion" value="<?=$asignacion->id_asignacion?>">
                                  <input required type="hidden" name="estado_asignacion" value="<?=$asignacion->estado_asignacion?>">
                                  <input required type="hidden" name="id_maquinaria" value="<?=$asignacion->id_maquinaria?>">                                                                    
                                  <?php
                                    if($asignacion->estado_asignacion == "Completada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-circle-check"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }elseif($asignacion->estado_asignacion == "Pendiente"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-arrow-right"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "En progreso"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-person-digging"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Atrasada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-clock"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Cancelada"){
                                      ?>
                                        <button disabled type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-xmark"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Suspendida"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-circle-exclamation"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }
                                  ?>
                                </form> 
                              <?php
                            }else{
                              ?>
                                <form method="POST" action="<?=base_url('empleados/asignaciones/AsignacionesController/CambiarEstadoAsignacion/')?>">
                                  <input required type="hidden" name="id_asignacion" value="<?=$asignacion->id_asignacion?>">
                                  <input required type="hidden" name="estado_asignacion" value="<?=$asignacion->estado_asignacion?>">
                                  <?php
                                    if($asignacion->estado_asignacion == "Completada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-circle-check"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }elseif($asignacion->estado_asignacion == "Pendiente"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-arrow-right"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "En progreso"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-person-digging"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Atrasada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-clock"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Cancelada"){
                                      ?>
                                        <button disabled type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-xmark"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Suspendida"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-circle-exclamation"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }
                                  ?>
                                </form>
                              <?php
                            }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>

            <div class="tab-pane" id="AsignacionesSuspendidas">
              <?php foreach ($contadorAsignacionesSuspendidas as $asignacion) { ?>
                <h3>ASIGNACIONES SUSPENDIDAS: <?=$asignacion->total_asignaciones?></h3>
              <?php } ?>
              <div class="row">
                <?php foreach ($asignacionesSuspendidas as $asignacion) { ?>
                  <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                      <div class="card-header text-muted border-bottom-0">
                        <?= $asignacion->id_asignacion ?>
                      </div>
                      <div class="card-body pt-0">
                        <div class="row">
                          <div class="col-12">
                            <h2 class="lead"><b>
                                <?= $asignacion->nombre_actividad ?>
                              </b></h2>
                            <p class="text-muted text-sm"><b>Informacion: </b></p>
                            <h2 class="lead"><b>
                                <?= $asignacion->descripcion ?>
                              </b></h2>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-location"></i></span>
                                UBICACION - <?= $asignacion->ubicacion ?>
                              </li>
                              <?php
                                if($asignacion->prioridad == "BAJA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-success"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }elseif($asignacion->prioridad == "MEDIA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-warning"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }elseif($asignacion->prioridad == "ALTA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-danger"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }
                              ?>
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-calendar-days"></i></span>
                                FECHA INICIO - <?= $asignacion->fecha_inicio ?>
                              </li>
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-calendar-days"></i></span>
                                FECHA FIN - <?= $asignacion->fecha_finalizacion ?>
                              </li>
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-tractor"></i></span>
                                MAQUINARIA - <?=$asignacion->nombre_maquinaria?>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="text-right">
                          <?php
                            if($session['rol']=="MECANICO"){
                              ?>
                                <form method="POST" action="<?=base_url('empleados/asignaciones/AsignacionesController/AsignacionMantenimiento/')?>">
                                  <input required type="hidden" name="id_asignacion" value="<?=$asignacion->id_asignacion?>">
                                  <input required type="hidden" name="estado_asignacion" value="<?=$asignacion->estado_asignacion?>">
                                  <input required type="hidden" name="id_maquinaria" value="<?=$asignacion->id_maquinaria?>">                                                                    
                                  <?php
                                    if($asignacion->estado_asignacion == "Completada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-circle-check"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }elseif($asignacion->estado_asignacion == "Pendiente"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-arrow-right"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "En progreso"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-person-digging"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Atrasada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-clock"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Cancelada"){
                                      ?>
                                        <button disabled type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-xmark"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Suspendida"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-circle-exclamation"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }
                                  ?>
                                </form> 
                              <?php
                            }else{
                              ?>
                                <form method="POST" action="<?=base_url('empleados/asignaciones/AsignacionesController/CambiarEstadoAsignacion/')?>">
                                  <input required type="hidden" name="id_asignacion" value="<?=$asignacion->id_asignacion?>">
                                  <input required type="hidden" name="estado_asignacion" value="<?=$asignacion->estado_asignacion?>">
                                  <?php
                                    if($asignacion->estado_asignacion == "Completada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-circle-check"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }elseif($asignacion->estado_asignacion == "Pendiente"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-arrow-right"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "En progreso"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-person-digging"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Atrasada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-clock"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Cancelada"){
                                      ?>
                                        <button disabled type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-xmark"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Suspendida"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-circle-exclamation"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }
                                  ?>
                                </form>
                              <?php
                            }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>

            <div class="tab-pane" id="AsignacionesCanceladas">
              <?php foreach ($contadorAsignacionesCanceladas as $asignacion) { ?>
                <h3>ASIGNACIONES CANCELADAS: <?=$asignacion->total_asignaciones?></h3>
              <?php } ?>
              <div class="row">
                <?php foreach ($asignacionesCanceladas as $asignacion) { ?>
                  <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                      <div class="card-header text-muted border-bottom-0">
                        <?= $asignacion->id_asignacion ?>
                      </div>
                      <div class="card-body pt-0">
                        <div class="row">
                          <div class="col-12">
                            <h2 class="lead"><b>
                                <?= $asignacion->nombre_actividad ?>
                              </b></h2>
                            <p class="text-muted text-sm"><b>Informacion: </b></p>
                            <h2 class="lead"><b>
                                <?= $asignacion->descripcion ?>
                              </b></h2>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-location"></i></span>
                                UBICACION - <?= $asignacion->ubicacion ?>
                              </li>
                              <?php
                                if($asignacion->prioridad == "BAJA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-success"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }elseif($asignacion->prioridad == "MEDIA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-warning"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }elseif($asignacion->prioridad == "ALTA"){
                                  ?>
                                  <li class="small"><span class="fa-li"><i class="fa-solid fa-circle-exclamation"></i></span>
                                    PRIORIDAD - <span class="text-danger"><?= $asignacion->prioridad?></span>
                                  </li>
                                  <?php
                                }
                              ?>
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-calendar-days"></i></span>
                                FECHA INICIO - <?= $asignacion->fecha_inicio ?>
                              </li>
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-calendar-days"></i></span>
                                FECHA FIN - <?= $asignacion->fecha_finalizacion ?>
                              </li>
                              <li class="small"><span class="fa-li"><i class="fa-solid fa-tractor"></i></span>
                                MAQUINARIA - <?=$asignacion->nombre_maquinaria?>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="text-right">
                          <?php
                            if($session['rol']=="MECANICO"){
                              ?>
                                <form method="POST" action="<?=base_url('empleados/asignaciones/AsignacionesController/AsignacionMantenimiento/')?>">
                                  <input required type="hidden" name="id_asignacion" value="<?=$asignacion->id_asignacion?>">
                                  <input required type="hidden" name="estado_asignacion" value="<?=$asignacion->estado_asignacion?>">
                                  <input required type="hidden" name="id_maquinaria" value="<?=$asignacion->id_maquinaria?>">                                                                    
                                  <?php
                                    if($asignacion->estado_asignacion == "Completada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-circle-check"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }elseif($asignacion->estado_asignacion == "Pendiente"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-arrow-right"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "En progreso"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-person-digging"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Atrasada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-clock"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Cancelada"){
                                      ?>
                                        <button disabled type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-xmark"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Suspendida"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-circle-exclamation"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }
                                  ?>
                                </form> 
                              <?php
                            }else{
                              ?>
                                <form method="POST" action="<?=base_url('empleados/asignaciones/AsignacionesController/CambiarEstadoAsignacion/')?>">
                                  <input required type="hidden" name="id_asignacion" value="<?=$asignacion->id_asignacion?>">
                                  <input required type="hidden" name="estado_asignacion" value="<?=$asignacion->estado_asignacion?>">
                                  <?php
                                    if($asignacion->estado_asignacion == "Completada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-circle-check"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }elseif($asignacion->estado_asignacion == "Pendiente"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-arrow-right"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "En progreso"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-person-digging"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Atrasada"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-clock"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Cancelada"){
                                      ?>
                                        <button disabled type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-xmark"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }if($asignacion->estado_asignacion == "Suspendida"){
                                      ?>
                                        <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-circle-exclamation"></i> <?=$asignacion->estado_asignacion?></button>
                                      <?php
                                    }
                                  ?>
                                </form>
                              <?php
                            }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php
$this->load->view('dashboard/empleados/layoutsEmpleados/footer');
?>



<script src="http://localhost/AgroControl/assets/plugins/jquery/jquery.min.js"></script>
<script src="http://localhost/AgroControl/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="http://localhost/AgroControl/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="http://localhost/AgroControl/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script
  src="http://localhost/AgroControl/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script
  src="http://localhost/AgroControl/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="http://localhost/AgroControl/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="http://localhost/AgroControl/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="http://localhost/AgroControl/assets/plugins/jszip/jszip.min.js"></script>
<script src="http://localhost/AgroControl/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="http://localhost/AgroControl/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="http://localhost/AgroControl/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="http://localhost/AgroControl/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="http://localhost/AgroControl/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="http://localhost/AgroControl/assets/dist/js/adminlte.min.js"></script>

</body>

</html>