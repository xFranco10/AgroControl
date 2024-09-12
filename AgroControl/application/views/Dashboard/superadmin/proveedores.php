<?php
  $this->load->view('dashboard/superadmin/layoutsSuperAdmin/header');
?>
  <?php
    $dataSidebar['session']=$session;
    $dataSidebar['OptionSelected']='proveedores';
    
    $this->load->view('dashboard/superadmin/layoutsSuperAdmin/sidebar',$dataSidebar);
  ?>

	<?php
		if (isset($proveedorinsertado)) {
			?>
				<script>
					Swal.fire({
						title: "REGISTRO EXITOSO",
						text: "El Proveedor se ha registrado correctamente",
						icon: "success"
					});
				</script>
				<meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Proveedores') ?>">
			<?php
		}elseif(isset($datorepetido)){
			?>
				<script>
					Swal.fire({
					title: "REGISTRO FALLIDO",
					text: "Los Datos ingresados del proveedor ya existen",
					icon: "error"
					});
				</script>
			  	<meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Proveedores')?>">
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
				<meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Proveedores')?>">
			<?php
		}elseif(isset($proveedoractualizado)){
			?>
				<script>
				Swal.fire({
					title: "ACTUALIZACION EXITOSA",
					text: "El proveedor fue actualizado exitosamente",
					icon: "success"
				});
				</script>
				<meta http-equiv="refresh" content="3;url=<?= base_url('superadmin/Dashboard/Proveedores')?>">
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
										<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-boxes-packing"></i> REGISTRAR PROVEEDOR</button>
									</div>
									<table id="example1" class="table table-bordered table-hover">
										<thead>
											<tr class="bg-dark">
												<th>ID</th>
												<th>NIT</th>
												<th>NOMBRE</th>
												<th>COD POSTAL</th>
												<th>DIRECCION</th>
												<th>TELEFONO</th>
												<th>E-MAIL</th>
												<th>EDITAR</th>
												<th>ELIMINAR</th>
											</tr>
										</thead>

										<tbody>
											<?php foreach ($Proveedores as $proveedor): ?>
												<tr>
													<td><?= $proveedor->id_proveedor ?></td>
													<td><?= $proveedor->nit ?></td>
													<td><?= $proveedor->nombre_proveedor ?></td>
													<td><?= $proveedor->codpostal ?></td>
													<td><?= $proveedor->direccion ?></td>
													<td><?= $proveedor->telefono ?></td>
													<td><?= $proveedor->email ?></td>
													<td class="text-center">
                                                        <a class="btn btn-outline-primary" title="EDITAR" href="<?=base_url('superadmin/proveedores/ProveedoresController/EditarProveedor/'.$proveedor->id_proveedor)?>"><i class="fa-solid fa-pen"></i></a>
												    </td>
													<td class="text-center">
														<button class="btn btn-outline-danger" title="ELIMINAR"  
														onclick="Swal.fire({
																title: '¿Deseas eliminar este proveedor?',
																text: 'No podras revertir este cambio!',
																icon: 'warning',
																confirmButtonColor: '#3085d6',
																showDenyButton: true,                                                                                                                                                                                          
																confirmButtonText: 'SI ELIMINAR',
																denyButtonText: 'NO ELIMINAR',
																}).then((result) => {                                                                                    
																if (result.isConfirmed) {
																	Swal.fire('Eliminado Correctamente!', '', 'success');
																	window.location.href='<?=base_url('superadmin/proveedores/ProveedoresController/deleteProveedores/'.$proveedor->id_proveedor)?>';
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
					<h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-boxes-packing"></i>
						REGISTRAR PROVEEDOR</h1>
				</div>
				<form action="<?= base_url('superadmin/proveedores/ProveedoresController/CrearProveedor') ?>" method="POST">
					<div class="modal-body">
						<div class="input-group mb-3">
							<input type="text" class="form-control custom-placeholder" name="nit" required placeholder="NIT">
							<div class="input-group-append">
								<div class="input-group-text">
									<i class="fa-solid fa-barcode"></i>
								</div>
							</div>
						</div>
						<div class="input-group mb-3">
							<input type="text" class="form-control custom-placeholder" name="nombre" required placeholder="NOMBRE">
							<div class="input-group-append">
								<div class="input-group-text">
									<i class="fa-solid fa-boxes-packing"></i>
								</div>
							</div>
						</div>
						<div class="input-group mb-3">
							<input type="text" class="form-control custom-placeholder" name="codpostal" required placeholder="CODIGO POSTAL">
							<div class="input-group-append">
								<div class="input-group-text">
									<i class="fa-solid fa-envelopes-bulk"></i>
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
							<input type="number" class="form-control custom-placeholder" name="telefono" required placeholder="TELEFONO">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-phone"></span>
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
