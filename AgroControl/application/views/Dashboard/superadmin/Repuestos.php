<?php
  $this->load->view('dashboard/superadmin/layoutsSuperAdmin/header');
?>
  <?php
    $dataSidebar['session']=$session;
    $dataSidebar['OptionSelected']='repuestos';
    
    $this->load->view('dashboard/superadmin/layoutsSuperAdmin/sidebar',$dataSidebar);
  ?>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
        </div>
      </section>
        <?php if (isset($dateValid)): ?>
        <script>
            Swal.fire({
            title: 'DATOS VALIDOS',
            text: 'El repuesto ha sido creado con éxito',
            icon: 'success',
            });
        </script>
          <meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Repuestos')?>">
        <?php endif ?>
        <?php if (isset($dateRepeated)): ?>
        <script>
            Swal.fire({
            title: 'DATOS REPETIDOS',
            text: 'El id del repuesto o el codigo ya existen, registre otro diferente.',
            icon: 'error',
            });
        </script>
          <meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Repuestos')?>">
        <?php endif ?>
        <?php if (isset($dateIncompletos)): ?>
        <script>
            Swal.fire({
            title: 'DATOS VACIOS',
            text: 'Digite todos los datos y registre nuevamente.',
            icon: 'error',
            });
        </script>
          <meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Repuestos')?>">
        <?php endif ?>
        <?php if (isset($repuestoctualizado)): ?>
        <script>
            Swal.fire({
            title: 'REPUESTO ACTALIZADO',
            text: 'El repuesto fue actualizado correctamente',
            icon: 'success',
            });
        </script>
          <meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Repuestos')?>">
        <?php endif ?>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-start py-2">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-toolbox"></i> REGISTRAR REPUESTO</button>
                  </div>
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr class="bg-dark">
                        <th>ID</th>
                        <th>CODIGO</th>
                        <th>NOMBRE</th>
                        <th>TIPO REPUESTO</th>
                        <th>CANTIDAD</th>
                        <th>PRECIO COMPRA</th>
                        <th>DESCRIPCION</th>
                        <th>PROVEEDOR</th>
                        <th>ESTADO</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($repuestos as $repuesto): ?>
                        <tr>
                          <td><?= $repuesto->id_repuesto ?></td>
                          <td><?= $repuesto->codigo ?></td>
                          <td><?= $repuesto->nombre_repuesto ?></td>
                          <td><?= $repuesto->tipo_repuesto ?></td>
                          <td><?= $repuesto->cantidad ?></td>
                          <td>$ <?=number_format($repuesto->precio_compra, 0, ',', '.') ?></td>
                          <td><?= $repuesto->descripcion ?></td>
                          <td><?= $repuesto->nombre_proveedor ?></td>
                          <td><?= $repuesto->estado_repuesto ?></td>
                          <td class="text-center">
                            <a class="btn btn-outline-primary" title="EDITAR" href="<?=base_url('superadmin/repuestos/RepuestosController/EditarRepuesto/'.$repuesto->id_repuesto)?>"><i class="fa-solid fa-pen"></i></a>
                          </td>
                          <td class="text-center">
                          <button class="btn btn-outline-danger" title="ELIMINAR"  
                              onclick="Swal.fire({
                                      title: '¿Deseas eliminar este repuesto?',
                                      text: 'No podras revertir este cambio!',
                                      icon: 'warning',
                                      confirmButtonColor: '#3085d6',
                                      showDenyButton: true,                                                                                                                                                                                          
                                      confirmButtonText: 'SI ELIMINAR',
                                      denyButtonText: 'NO ELIMINAR',
                                    }).then((result) => {                                                                                    
                                      if (result.isConfirmed) {
                                        window.location.href='<?=base_url('superadmin/repuestos/RepuestosController/deleteRepuestos/'.$repuesto->id_repuesto)?>';
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

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>

  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-toolbox"></i> REGISTRAR REPUESTO</h1>
        </div>
        <form action="<?=base_url('superadmin/repuestos/RepuestosController/insertRepuesto') ?>" method="POST">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="input-group mb-3">
                    <input type="number" class="form-control custom-placeholder" name="codigo"  placeholder="CODIGO">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <i class="fa-solid fa-barcode"></i>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control custom-placeholder" name="nombre"  placeholder="NOMBRE">
                        <div class="input-group-append">
                            <div class="input-group-text">
                              <i class="fa-solid fa-toolbox"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                  <select class="form-select custom-placeholder" name="tipo_repuesto" id="">
                    <option value="" disabled selected style="color: gray;">TIPO REPUESTO</option>
                    <option value="Motor">Motor</option>
                    <option value="Transmision">Transmision</option>
                    <option value="Suspension">Suspension</option>
                    <option value="Frenos">Frenos</option>
                    <option value="Electricos">Electricos</option>
                    <option value="Carroceria">Carroceria</option>
                    <option value="Neumaticos">Neumaticos</option>
                    <option value="Herramientas/Taller">Herramientas/Taller</option>
                  </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <input type="number" class="form-control custom-placeholder" name="cantidad"  placeholder="CANTIDAD">
                        <div class="input-group-append">
                            <div class="input-group-text">
                              <i class="fa-solid fa-arrow-up-wide-short"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <input type="number" class="form-control custom-placeholder" name="precio_compra"  placeholder="PRECIO COMPRA">
                        <div class="input-group-append">
                            <div class="input-group-text">
                              <i class="fa-solid fa-dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="input-group mb-3">
                      <textarea class="form-control custom-placeholder" aria-label="With textarea" name="descripcion" placeholder="DESCRIPCION"></textarea>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-circle-info"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
              <div class="row mb-3">
                  <div class="col-md-6">
                    <select class="form-select custom-placeholder" id="id_proveedor" name="id_proveedor">
                      <option value="" disabled selected style="color: gray;">PROVEEDOR</option>
                      <?php foreach ($proveedores as $proveedor): ?>
                        <option value="<?=$proveedor->id_proveedor?>"><?= $proveedor->nombre_proveedor?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-md-6">
                      <select class="form-select custom-placeholder" name="estado" id="">
                        <option value="" disabled selected>ESTADO</option>
                        <option value="DISPONIBLE">DISPONIBLE</option>
                        <option value="NO DISPONIBLE">NO DISPONIBLE</option>
                        <option value="PEDIDO">PEDIDO</option>
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