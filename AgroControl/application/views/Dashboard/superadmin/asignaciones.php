<?php
  $this->load->view('dashboard/superadmin/layoutsSuperAdmin/header');
?>
  <?php
    $dataSidebar['session']=$session;
    $dataSidebar['OptionSelected']='asignaciones';
    
    $this->load->view('dashboard/superadmin/layoutsSuperAdmin/sidebar',$dataSidebar);
  ?>
    <?php
      if (isset($InsertAsignacion)) {
        ?>
          <script>
            Swal.fire({
              title: "REGISTRO EXITOSO",
              text: "La asignacion se ha registrado correctamente",
              icon: "success"
            });
          </script>
          <meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Asignaciones')?>">
        <?php
      }elseif(isset($datorepetido)){
        ?>
          <script>
            Swal.fire({
              title: "REGISTRO FALLIDO",
              text: "Datos ingresados del usuario ya existen",
              icon: "error"
            });
          </script>
          <meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Asignaciones')?>">
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
          <meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Asignaciones')?>">
        <?php
      }elseif(isset($asignacionActualizada)){
        ?>
          <script>
            Swal.fire({
              title: "ACTUALIZACION EXITOSA",
              text: "La asignacion fue modificada exitosamente",
              icon: "success"
            });
          </script>
          <meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Asignaciones')?>">
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
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-start py-2">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCreate"><i class="fa-solid fa-circle-check"></i> REGISTRAR ASIGNACION</button>
                  </div>
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr class="bg-dark">
                        <th>ID</th>
                        <th>ACTIVIDAD</th>
                        <th>USUARIO</th>
                        <th>MAQUINARIA</th>
                        <th>ESTADO</th>
                        <th>FECHA INICIO</th>
                        <th>FECHA FIN</th>
                        <th>MODIFICAR</th>
                        <th>ELIMINAR</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($asignaciones as $asignacion): ?>
                        <tr>
                          <td><?= $asignacion->id_asignacion ?></td>
                          <td><?= $asignacion->nombre_actividad ?></td>
                          <td><?= $asignacion->nombre ?></td>
                          <td><?= $asignacion->nombre_maquinaria ?></td>
                          <?php
                          if ($asignacion->estado_asignacion == "Completada") {
                            ?>
                              <td class="table-success"><?= $asignacion->estado_asignacion ?></td>
                            <?php
                          } elseif ($asignacion->estado_asignacion == "Cancelada") {
                            ?>
                              <td class="table-danger"><?= $asignacion->estado_asignacion ?></td>
                            <?php
                          }elseif ($asignacion->estado_asignacion == "En progreso") {
                            ?>
                              <td class="table-secondary"><?= $asignacion->estado_asignacion ?></td>
                            <?php
                          }elseif ($asignacion->estado_asignacion == "Suspendida") {
                            ?>
                              <td class="table-secondary"><?= $asignacion->estado_asignacion ?></td>
                            <?php
                          }elseif ($asignacion->estado_asignacion == "Atrasada") {
                            ?>
                              <td class="table-warning"><?= $asignacion->estado_asignacion ?></td>
                            <?php
                          }elseif ($asignacion->estado_asignacion == "Pendiente") {
                            ?>
                              <td class="table-warning"><?= $asignacion->estado_asignacion ?></td>
                            <?php
                          }
                          ?>
                          <td><?= $asignacion->fecha_inicio ?></td>
                          <td><?= $asignacion->fecha_finalizacion ?></td>
                          <td class="text-center">
                            <a class="btn btn-outline-primary" title="EDITAR" href="<?=base_url('superadmin/asignaciones/AsignacionesController/viewForUpdate/'.$asignacion->id_asignacion)?>"><i class="fa-solid fa-user-pen"></i></a>
                          </td>
                          <td class="text-center">
                            <button class="btn btn-outline-danger" title="ELIMINAR"  
                              onclick="Swal.fire({
                                      title: '¿Deseas eliminar esta asignacion?',
                                      text: 'No podras revertir este cambio!',
                                      icon: 'warning',
                                      confirmButtonColor: '#3085d6',
                                      showDenyButton: true,                                                                                                                                                                                          
                                      confirmButtonText: 'SI ELIMINAR',
                                      denyButtonText: 'NO ELIMINAR',
                                    }).then((result) => {                                                                                    
                                      if (result.isConfirmed) {
                                        window.location.href='<?=base_url('superadmin/asignaciones/AsignacionesController/deleteAsignacion/'.$asignacion->id_asignacion)?>';
                                        Swal.fire('Eliminado Correctamente!', '', 'success');
                                      } else if (result.isDenied) {
                                        Swal.fire('No Se Realizaron Cambios', '', 'info');
                                      }
                                    });"><i class="fa-solid fa-trash-can"></i>
                            </button> 
                          </td>
                        </tr>
                      <?php endforeach; ?> 
                    </tbody>
                  </table>
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

  <!-- Modal -->
  <div class="modal fade" id="modalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-user-plus"></i> REGISTRAR ASIGNACIONES</h1>
        </div>
        <form action="<?= base_url('superadmin/asignaciones/AsignacionesController/insertAsignacion') ?>" method="POST">
          <div class="modal-body">
            <div class="row">

              <div class="col-md-6">
                <select class="form-select custom-placeholder" id="id_actividad" name="id_actividad">
                  <option value="" disabled selected style="color: gray;">ACTIVIDAD</option>
                  <?php foreach ($actividades as $actividad): ?>
                    <option value="<?=$actividad->id_actividad?>"><?= $actividad->nombre_actividad ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="col-md-6">
                <select class="form-select custom-placeholder" name="id_usuario">
                  <option value="" disabled selected style="color: gray;">USUARIO</option>
                  <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?=$usuario->id_usuario?>"><?= $usuario->nombre?> - <?=$usuario->rol?></option>
                  <?php endforeach; ?>
                </select>
              </div>

            </div>
            <div class="row mt-3">

              <div class="col-md-6">
                <select class="form-select custom-placeholder" name="id_maquinaria">
                  <option value="" disabled selected style="color: gray;">MAQUINARIAS</option>
                  <?php foreach ($maquinarias as $maquinaria): ?>
                    <option value="<?=$maquinaria->id_maquinaria?>"><?= $maquinaria->nombre_maquinaria?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="col-md-6">
                <select class="form-select custom-placeholder" name="estado_asignacion">
                  <option value="" disabled selected style="color: gray;">ESTADO ASIGNACION</option>
                  <option value="Pendiente">PENDIENTE</option>
                  <option value="En progreso">EN PROGRESO</option>
                  <option value="Completada">COMPLETADA</option>
                  <option value="Suspendida">SUSPENDIDA</option>
                  <option value="Cancelada">CANCELADA</option>
                  <option value="Atrasada">ATRASADA</option>
                </select>
              </div>

            </div>

            <div class="row mt-3">

              <div class="col-md-6 input-group mb-3">
                <input type="text" class="form-control custom-placeholder" name="fecha_inicio" required readonly style="color: gray;" value="<?= date('Y-m-d') ?>">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fa-solid fa-calendar-days"></span>
                  </div>
                </div>
              </div>

              <div class="col-md-6 input-group mb-3">
                <input type="date" class="form-control custom-placeholder" name="fecha_finalizacion" required>
              </div>

            </div>  
                 
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">CANCELAR</button>
            <button type="submit" class="btn btn-outline-success">REGISTRAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script src="http://localhost/AgroControl/assets/plugins/jquery/jquery.min.js"></script>
  <script
    src="http://localhost/AgroControl/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script
    src="http://localhost/AgroControl/assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script
    src="http://localhost/AgroControl/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script
    src="http://localhost/AgroControl/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script
    src="http://localhost/AgroControl/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script
    src="http://localhost/AgroControl/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script
    src="http://localhost/AgroControl/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="http://localhost/AgroControl/assets/plugins/jszip/jszip.min.js"></script>
  <script src="http://localhost/AgroControl/assets/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="http://localhost/AgroControl/assets/plugins/pdfmake/vfs_fonts.js"></script>
  <script
    src="http://localhost/AgroControl/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script
    src="http://localhost/AgroControl/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script
    src="http://localhost/AgroControl/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="http://localhost/AgroControl/assets/dist/js/adminlte.min.js"></script>


  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>


</body>

</html>
