<?php
	$dataHeader['session']=$session;
  	$this->load->view('dashboard/empleados/layoutsEmpleados/header');
?>
  <?php
    $dataSidebar['session']=$session;
    $dataSidebar['OptionSelected']='Perfil';
    
    $this->load->view('dashboard/empleados/layoutsEmpleados/sidebar',$dataSidebar);
  ?>

	<?php foreach ($contadorAsignacionesAtrasadas as $asignacion) { ?>
		<?php
			if ($asignacion->total_asignaciones != 0) {
				?>
					<script>
		
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
							timerProgressBar: true,
							didOpen: (toast) => {
								toast.onmouseenter = Swal.stopTimer;
								toast.onmouseleave = Swal.resumeTimer;
							}
						});

						Toast.fire({
							icon: "warning",
							title: "Tiene un total de <?=$asignacion->total_asignaciones?> asignaciones atrasadas, debe realizarlas lo mas pronto posible."
						});

						// Swal.fire({
						// 	position: "top-end",
						// 	icon: "warning",
						// 	title: "¡ASIGNACIONES ATRASADAS!",
						// 	text: "Tiene un total de <?=$asignacion->total_asignaciones?> asignaciones atrasadas, debe realizarlas lo mas pronto posible.",
						// 	showConfirmButton: false,
						// 	timer: 4000,
						// });

					</script>
				<?php
			}
		?>
	<?php } ?>

		<div class="content-wrapper">
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							
						</div>
					</div>
				</div>
			</section>

			<section class="content">
				<div class="row">
					<div class="col-lg-3 col-6">
						<div class="small-box bg-danger">
						<div class="inner">
							<?php foreach ($contadorAsignacionesAtrasadas as $asignacion) { ?>
								<h3><?=$asignacion->total_asignaciones?></h3>
							<?php } ?>
							<p>Asignaciones Atrasadas</p>
						</div>
						<div class="icon">
							<i class="ion ion-clock"></i>
						</div>
						<a href="<?=base_url('empleados/Dashboard/Asignaciones')?>" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>

					<div class="col-lg-3 col-6">
						<div class="small-box bg-dark">
						<div class="inner">
							<?php foreach ($contadorAsignacionesPendientes as $asignacion) { ?>
								<h3><?=$asignacion->total_asignaciones?></h3>
							<?php } ?>
							<p>Asignaciones Pendientes</p>
						</div>
						<div class="icon">
							<i class="ion ion-arrow-right-b"></i>
						</div>
						<a href="<?=base_url('empleados/Dashboard/Asignaciones')?>" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>

					<div class="col-lg-3 col-6">
						<div class="small-box bg-primary">
							<div class="inner">
								<?php foreach ($contadorAsignacionesProgreso as $asignacion) { ?>
									<h3><?=$asignacion->total_asignaciones?></h3>
								<?php } ?>
								<p>Asignaciones En Progreso</p>
							</div>
						<div class="icon">
							<i class="ion ion-android-walk"></i>
						</div>
						<a href="<?=base_url('empleados/Dashboard/Asignaciones')?>" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>

					<div class="col-lg-3 col-6">
						<div class="small-box bg-lime">
						<div class="inner">
							<?php foreach ($contadorAsignacionesCompletadas as $asignacion) { ?>
								<h3><?=$asignacion->total_asignaciones?></h3>
							<?php } ?>
							<p>Asignaciones Completadas</p>
						</div>
						<div class="icon">
							<i class="ion ion-android-checkmark-circle"></i>
						</div>
							<a href="<?=base_url('empleados/Dashboard/Asignaciones')?>" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Bienvenido a Nuestra Página Principal</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
								<i class="fas fa-minus"></i>
							</button>
							<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
								<i class="fas fa-times"></i>
							</button>
						</div>
					</div>
					<div class="card-body">
						<p>
							¡Excelente noticia! Te informamos que has iniciado sesión satisfactoriamente en nuestro programa. Ahora
							tienes acceso a ver y realizar tus tareas asignadas en tu area de trabajo.
						</p>
						<p>
							Estamos aquí para ayudarte. Si tienes alguna pregunta o necesitas asistencia
							adicional, no dudes en ponerte en contacto con nuestro equipo de soporte. ¡Gracias por confiar en
							nosotros!
						</p>
					</div>
					<div class="card-footer">
						<h4><b><i><?=$session['rol']?></i></b></h4>
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


	

	<script src="http://localhost/AgroControl/assets/plugins/jquery/jquery.min.js"></script>
	<script src="http://localhost/AgroControl/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="http://localhost/AgroControl/assets/dist/js/adminlte.min.js"></script>
	<script src="http://localhost/AgroControl/assets/plugins/moment/moment.min.js"></script>
	<script src="http://localhost/AgroControl/assets/plugins/toastr/toastr.min.js"></script>

</body>

</html>
