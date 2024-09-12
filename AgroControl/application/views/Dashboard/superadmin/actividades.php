<?php
  $this->load->view('dashboard/superadmin/layoutsSuperAdmin/header');
?>
  <?php
    $dataSidebar['session']=$session;
    $dataSidebar['OptionSelected']='actividades';
    
    $this->load->view('dashboard/superadmin/layoutsSuperAdmin/sidebar',$dataSidebar);
  ?>
  <?php
		if (isset($actividadinsertada)) {
			?>
				<script>
					Swal.fire({
						title: "REGISTRO EXITOSO",
						text: "La actividad se ha registrado correctamente",
						icon: "success"
					});
				</script>
				<meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Actividades') ?>">
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
				<meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Actividades')?>">
			<?php
		}elseif(isset($actividadactualizada)){
			?>
				<script>
				Swal.fire({
					title: "ACTUALIZACION EXITOSA",
					text: "La actividad fue actualizada exitosamente",
					icon: "success"
				});
				</script>
				<meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Actividades')?>">
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
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                      data-bs-target="#staticBackdrop"><i class="fa-solid fa-list"></i> REGISTRAR ACTIVIDAD</button>
                  </div>
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr class="bg-dark">
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>DESCRIPCION</th>
                        <th>UBICACION</th>
                        <th>ESTADO</th>
                        <th>PRIORIDAD</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($Actividades as $actividad): ?>
                        <tr>
                          <td><?= $actividad->id_actividad ?></td>
                          <td><?= $actividad->nombre_actividad ?></td>
                          <td><?= $actividad->descripcion ?></td>
                          <td><?= $actividad->ubicacion ?></td>
                          <?php
                            if ($actividad->estado_actividad == "DISPONIBLE") {
                              ?>
                              <td class="table-success"><?= $actividad->estado_actividad ?></td>
                              <?php
                            } elseif ($actividad->estado_actividad == "NO DISPONIBLE") {
                              ?>
                              <td class="table-danger"><?= $actividad->estado_actividad ?></td>
                              <?php
                            }
                          ?>
                          <?php
                            if ($actividad->prioridad == "ALTA") {
                              ?>
                              <td class="table-danger"><?= $actividad->prioridad ?></td>
                              <?php
                            } elseif ($actividad->prioridad == "MEDIA") {
                              ?>
                              <td class="table-warning"><?= $actividad->prioridad ?></td>
                              <?php
                            }elseif ($actividad->prioridad == "BAJA") {
                              ?>
                              <td class="table-success"><?= $actividad->prioridad ?></td>
                              <?php
                            }
                          ?>

                          <td class="text-center">
                            <a href="<?= base_url('superadmin/actividades/ActividadesController/EditarActividad/'.$actividad->id_actividad) ?>"><button
                                class="btn btn-outline-primary" title="EDITAR"><i
                                  class="fa-solid fa-pen"></i></button></a>
                          </td>
                          <td class="text-center">
                          <button class="btn btn-outline-danger" title="ELIMINAR"  
                              onclick="Swal.fire({
                                      title: '¿Deseas eliminar esta actividad?',
                                      text: 'No podras revertir este cambio!',
                                      icon: 'warning',
                                      confirmButtonColor: '#3085d6',
                                      showDenyButton: true,                                                                                                                                                                                          
                                      confirmButtonText: 'SI ELIMINAR',
                                      denyButtonText: 'NO ELIMINAR',
                                    }).then((result) => {                                                                                    
                                      if (result.isConfirmed) {
                                        window.location.href='<?=base_url('superadmin/actividades/ActividadesController/deleteActividad/'.$actividad->id_actividad)?>'
                                        Swal.fire('Eliminada Correctamente!', '', 'success');
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

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-list"></i> REGISTRAR ACTIVIDAD</h1>
        </div>
        <form action="<?= base_url('superadmin/actividades/ActividadesController/CrearActividad')?>" method="POST">
          <div class="modal-body">
            <div class="input-group mb-3">
              <input type="text" class="form-control custom-placeholder" name="nombre" required placeholder="NOMBRE">
              <div class="input-group-append">
                <div class="input-group-text">
                  <i class="fa-solid fa-list"></i>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-append">
                <textarea name="descripcion" class="form-control custom-placeholder" cols="100%" rows="10" placeholder="DESCRIPCION" required></textarea>
                <div class="input-group-text">
                  <i class="fa-solid fa-circle-info"></i>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control custom-placeholder" name="ubicacion" required placeholder="UBICACION">
              <div class="input-group-append">
                <div class="input-group-text">
                  <i class="fa-solid fa-location"></i>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6 text-center">
                <label for="estado">ESTADO</label>
                <select class="form-select custom-placeholder" name="estado">
                  <option value="DISPONIBLE">DISPONIBLE</option>
                  <option value="NO DISPONIBLE">NO DISPONIBLE</option>
                </select>
              </div>
              <div class="col-md-6 text-center">
                <label for="prioridad">PRIORIDAD</label>
                <select class="form-select custom-placeholder" name="prioridad">
                  <option value="BAJA">BAJA</option>
                  <option value="MEDIA">MEDIA</option>
                  <option value="ALTA">ALTA</option>
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