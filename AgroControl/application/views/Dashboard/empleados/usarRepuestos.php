<?php
$dataHeader['session'] = $session;
$this->load->view('dashboard/empleados/layoutsEmpleados/header');
?>

<?php
$dataSidebar['session'] = $session;
$dataSidebar['OptionSelected'] = 'asignaciones';

$this->load->view('dashboard/empleados/layoutsEmpleados/sidebar', $dataSidebar);
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
          <button title="Informacion De Asignacion" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-info"></i></button>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                          <h5>Seleccione los repuestos necesarios para realizar el mantenimiento/reparacion <i class="fa-solid fa-circle-check"></i></h5>
                          <div class="py-2">
                            <button id="" class="btn bg-lime" data-bs-toggle="modal" data-bs-target="#staticBackdropListaRepuestos"><i class="fa-solid fa-toolbox"></i> VER REPUESTOS SELECCIONADOS</button>
                          </div>

                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr class="bg-dark">
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>TIPO REPUESTO</th>
                                        <th>CANTIDAD</th>
                                        <th>DESCRIPCION</th>
                                        <th>PROVEEDOR</th>
                                        <th>USAR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($repuestos as $repuesto): ?>
                                        <tr class="">
                                            <td>
                                              <p class="idrepuesto"> <?= $repuesto->id_repuesto ?></p>
                                            </td>
                                            <td>
                                                <?= $repuesto->nombre_repuesto ?>
                                            </td>
                                            <td>
                                                <?= $repuesto->tipo_repuesto ?>
                                            </td>
                                            <td>
                                                <p class="cant"><?= $repuesto->cantidad ?></p>
                                            </td>
                                            <td>
                                                <?= $repuesto->descripcion ?>
                                            </td>
                                            <td>
                                                <?= $repuesto->nombre_proveedor ?>
                                            </td>     
                                            <td>
                                                <button class="btn btn-primary btn-add-cart">USAR</button>
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
$this->load->view('dashboard/empleados/layoutsEmpleados/footer');
?>

<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>

<div class="modal fade" id="staticBackdropListaRepuestos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-toolbox"></i> LISTA DE REPUESTOS</h1>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-center mb-4">
          <div class="contenedor py-2 text-center bg-white">
            <div id="carrito-container"></div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">CERRAR LISTA</button>
        <button id="enviar-carrito" data-bs-dismiss="modal" class="btn btn-outline-primary">USAR ESTOS REPUESTOS</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h1 class="modal-title fs-5" id="exampleModalLabel">INFORMACION SOBRE LA ASIGNACION</h1>
      </div>
      <div class="modal-body">
        <h3>Id de la asignacion:</h3>
        <h4 id="idAsignacion"><?=$id_asignacion?></h4>
        <h3>Estado de la asignacion:</h3>
        <h4 id="estado_Asignacion"><?=$estado_asignacion?></h4>
        <h3>Id de la maquinaria:</h3>
        <h4 id="id_maquinaria"><?=$id_maquinaria?></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="http://localhost/AgroControl/assets/dist/js/listarepuestos.js"></script>
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
  <script src="index.js"></script>


  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["colvis"]
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