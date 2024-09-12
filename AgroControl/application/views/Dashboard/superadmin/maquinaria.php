<?php
  $this->load->view('dashboard/superadmin/layoutsSuperAdmin/header');
?>
  <?php
    $dataSidebar['session']=$session;
    $dataSidebar['OptionSelected']='maquinaria';
    
    $this->load->view('dashboard/superadmin/layoutsSuperAdmin/sidebar',$dataSidebar);
  ?>
    <?php
      if (isset($maquinariainsertada)) {
        ?>
          <script>
            Swal.fire({
              title: "REGISTRO EXITOSO",
              text: "La maquinaria se ha registrado correctamente",
              icon: "success"
            });
          </script>
          <meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Maquinaria')?>">
        <?php
      }elseif(isset($datorepetido)){
        ?>
          <script>
            Swal.fire({
              title: "REGISTRO FALLIDO",
              text: "Datos ingresados de la maquinaria ya existen",
              icon: "error"
            });
          </script>
          <meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Maquinaria')?>">
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
          <meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Maquinaria')?>">
        <?php
      }elseif(isset($maquinariactualizada)){
        ?>
          <script>
            Swal.fire({
              title: "ACTUALIZACION EXITOSA",
              text: "La maquinaria fue actualizada exitosamente",
              icon: "success"
            });
          </script>
          <meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Maquinaria')?>">
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
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-tractor"></i> REGISTRAR MAQUINARIA</button>
                  </div>
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr class="bg-dark">
                        <th>ID</th>
                        <th>SERIE</th>
                        <th>NOMBRE</th>
                        <th>FABRICANTE</th>
                        <th>ADQUISICION</th>
                        <th>COSTO</th>
                        <th>TIPO</th>
                        <th>ESTADO</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php foreach ($maquinas as $maquinaria): ?>
                        <tr>
                          <td><?= $maquinaria->id_maquinaria ?></td>
                          <td><?= $maquinaria->num_serie?></td>
                          <td><?= $maquinaria->nombre_maquinaria ?></td>
                          <td><?= $maquinaria->fabricante ?></td>
                          <td><?= $maquinaria->fecha_adquisicion ?></td>                       
                          <td>$ <?=number_format($maquinaria->costo_adquisicion, 0, ',', '.') ?></td>
                          <td><?= $maquinaria->tipo_maquinaria ?></td>
                          <?php
                          if ($maquinaria->estado_maquinaria == "ACTIVA") {
                            ?>
                              <td class="table-success"><?= $maquinaria->estado_maquinaria ?></td>
                            <?php
                          } elseif ($maquinaria->estado_maquinaria == "INACTIVA") {
                            ?>
                              <td class="table-danger"><?= $maquinaria->estado_maquinaria ?></td>
                            <?php
                          }elseif ($maquinaria->estado_maquinaria == "SUSPENDIDA") {
                            ?>
                              <td class="table-light"><?= $maquinaria->estado_maquinaria ?></td>
                            <?php
                          }elseif ($maquinaria->estado_maquinaria == "MANTENIMIENTO") {
                            ?>
                              <td class="table-primary"><?= $maquinaria->estado_maquinaria ?></td>
                            <?php
                          }
                          ?>
                          <td class="text-center">
                            <a class="btn btn-outline-primary" title="EDITAR" href="<?=base_url('superadmin/maquinaria/MaquinariaController/EditarMaquinaria/'.$maquinaria->id_maquinaria)?>"><i class="fa-solid fa-user-pen"></i></a>
                          </td>
                          <td class="text-center">
                            <button class="btn btn-outline-danger" title="ELIMINAR"  
                              onclick="Swal.fire({
                                      title: '¿Deseas eliminar esta maquinaria?',
                                      text: 'No podras revertir este cambio!',
                                      icon: 'warning',
                                      confirmButtonColor: '#3085d6',
                                      showDenyButton: true,                                                                                                                                                                                          
                                      confirmButtonText: 'SI ELIMINAR',
                                      denyButtonText: 'NO ELIMINAR',
                                    }).then((result) => {                                                                                    
                                      if (result.isConfirmed) {
                                        window.location.href='<?=base_url('superadmin/maquinaria/MaquinariaController/deleteMaquinaria/'.$maquinaria->id_maquinaria)?>';
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
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-tractor"></i> REGISTRAR MAQUINARIA</h1>
        </div>
        <form action="<?=base_url('superadmin/maquinaria/MaquinariaController/RegistrarMaquinaria') ?>" method="POST">
          <div class="modal-body">
            <div class="input-group mb-3">
              <input type="text" class="form-control custom-placeholder" name="num_serie" required placeholder="NUMERO DE SERIE">
              <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fa-solid fa-hashtag"></i>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control custom-placeholder" name="nombre" required placeholder="NOMBRE">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-tractor"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control custom-placeholder" name="fabricante" required placeholder="FABRICANTE">
              <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                </div>
              </div>
            </div>
            <label class="label-form" for="fecha_adquisicion">FECHA DE ADQUSICION</label>
            <div class="input-group mb-3">
                <input type="date" class="form-control custom-placeholder" name="fecha_adquisicion" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
              <input type="number" class="form-control custom-placeholder" name="costo_adquisicion" required placeholder="COSTO DE ADQUSICION">
              <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fa-solid fa-dollar-sign"></i>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <select class="form-select custom-placeholder" name="tipo" id="">
                    <option value="" disabled selected>TIPO DE MAQUINARIA</option>
                    <option value="Maquinaria Pesada">Maquinaria Pesada</option>
                    <option value="Maquinaria Ligera">Maquinaria Ligera</option>
                    <option value="Equipos Manuales">Equipos Manuales</option>
                    <option value="Equipos Automatizados">Equipos Automatizados</option>
                </select>
              </div>
              <div class="col-md-6">
                <select class="form-select custom-placeholder" name="estado" id="">
                    <option value="" disaselectbled selected>ESTADO</option>
                    <option value="ACTIVA">ACTIVA</option>
                    <option value="INACTIVA">INACTIVA</option>
                    <option value="SUSPENDIDA">SUSPENDIDA</option>
                    <option value="MANTENIMIENTO">MANTENIMIENTO</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">CANCELAR</button>
            <button type="submit" class="btn btn-outline-success">REGISTRAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>


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
