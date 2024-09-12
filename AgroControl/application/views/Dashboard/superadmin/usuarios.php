<?php
  $this->load->view('dashboard/superadmin/layoutsSuperAdmin/header');
?>
  <?php
    $dataSidebar['session']=$session;
    $dataSidebar['OptionSelected']='usuarios';
    
    $this->load->view('dashboard/superadmin/layoutsSuperAdmin/sidebar',$dataSidebar);
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
          <meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Usuarios')?>">
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
          <meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Usuarios')?>">
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
          <meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Usuarios')?>">
        <?php
      }elseif(isset($usuarioactualizado)){
        ?>
          <script>
            Swal.fire({
              title: "ACTUALIZACION EXITOSA",
              text: "El usuario fue actualizado exitosamente",
              icon: "success"
            });
          </script>
          <meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Usuarios')?>">
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
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-user-plus"></i> REGISTRAR USUARIO</button>
                  </div>
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr class="bg-dark">
                        <th>ID</th>
                        <th>CEDULA</th>
                        <th>NOMBRES</th>
                        <th>APELLIDOS</th>
                        <th>TELEFONO</th>
                        <th>DIRECCION</th>
                        <th>ROL</th>
                        <th>EMAIL</th>
                        <th>ESTADO</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php foreach ($Usuarios as $usuario): ?>
                        <tr>
                          <td><?= $usuario->id_usuario ?></td>
                          <td><?= $usuario->documento ?></td>
                          <td><?= $usuario->nombre ?></td>
                          <td><?= $usuario->apellido ?></td>
                          <td><?= $usuario->telefono ?></td>
                          <td><?= $usuario->direccion ?></td>
                          <td><?= $usuario->rol ?></td>
                          <td><?= $usuario->email ?></td>
                          <?php
                          if ($usuario->estado == "ACTIVO") {
                            ?>
                              <td class="table-success"><?= $usuario->estado ?></td>
                            <?php
                          } elseif ($usuario->estado == "INACTIVO") {
                            ?>
                              <td class="table-danger"><?= $usuario->estado ?></td>
                            <?php
                          }
                          ?>
                          <td class="text-center">
                            <a class="btn btn-outline-primary" title="EDITAR" href="<?=base_url('superadmin/usuarios/UsersController/EditarUsuario/'.$usuario->id_usuario)?>"><i class="fa-solid fa-user-pen"></i></a>
                          </td>
                          <td class="text-center">
                            <button class="btn btn-outline-danger" title="ELIMINAR"  
                              onclick="Swal.fire({
                                      title: '¿Deseas eliminar este usuario?',
                                      text: 'No podras revertir este cambio!',
                                      icon: 'warning',
                                      confirmButtonColor: '#3085d6',
                                      showDenyButton: true,                                                                                                                                                                                          
                                      confirmButtonText: 'SI ELIMINAR',
                                      denyButtonText: 'NO ELIMINAR',
                                    }).then((result) => {                                                                                    
                                      if (result.isConfirmed) {
                                        window.location.href='<?=base_url('superadmin/usuarios/UsersController/deleteUsuario/'.$usuario->id_usuario)?>';
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
          <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-user-plus"></i> REGISTRAR USUARIOS</h1>
        </div>
        <form action="<?= base_url('superadmin/usuarios/UsersController/CrearUsuario') ?>" method="POST">
          <div class="modal-body">
            <div class="input-group mb-3">
              <input type="number" class="form-control custom-placeholder" name="documento" required placeholder="NUMERO DE DOCUMENTO">
              <div class="input-group-append">
                <div class="input-group-text">
                  <i class="fa-solid fa-address-card"></i>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control custom-placeholder" name="nombres" required placeholder="NOMBRES">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control custom-placeholder" name="apellidos" required placeholder="APELLIDOS">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="number" class="form-control custom-placeholder" name="telefono" required placeholder="TELEFONO">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-phone"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control custom-placeholder" name="direccion" required placeholder="DIRECCION">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-location"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="email" class="form-control custom-placeholder" name="email" required placeholder="EMAIL">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control custom-placeholder" name="password" required placeholder="CONTRASEÑA">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <select class="form-select custom-placeholder" name="rol" id="">
                  <option value="SUPERADMIN">SUPERADMIN</option>
                  <option value="ADMIN">ADMIN</option>
                  <option value="AGRICULTORES">AGRICULTORES</option>
                  <option value="JARDINEROS">JARDINEROS</option>
                  <option value="OPERADOR MAQUINARIA">OPERADOR MAQUINARIA</option>
                  <option value="GANADEROS">GANADEROS</option>
                  <option value="ASEADOR">ASEADOR</option>
                  <option value="PERSONAL MANTENIMIENTO">PERSONAL MANTENIMIENTO</option>
                  <option value="MECANICO">MECANICO</option>
                </select>
              </div>
              <div class="col-md-6">
                <select class="form-select custom-placeholder" name="estado" id="">
                  <option value="ACTIVO">ACTIVO</option>
                  <option value="INACTIVO">INACTIVO</option>
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
