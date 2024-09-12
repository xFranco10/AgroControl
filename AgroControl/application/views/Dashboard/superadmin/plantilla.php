<?php
  $this->load->view('dashboard/superadmin/layoutsSuperAdmin/header');
?>
  <?php
    $dataSidebar['session']=$session;
    $dataSidebar['OptionSelected']='';
    
    $this->load->view('dashboard/superadmin/layoutsSuperAdmin/sidebar',$dataSidebar);
  ?>
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
						<!-- small box -->
						<div class="small-box bg-dark">
						<div class="inner">
							<h3><?=$proveedorestotales?></h3>
							<p>Provedores Registrados</p>
						</div>
						<div class="icon">
							<i class="ion ion-ios-box"></i>
						</div>
						<a href="<?=base_url('superadmin/Dashboard/Proveedores')?>" class="small-box-footer">Proveedores <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-6">
						<!-- small box -->
						<div class="small-box bg-success">
						<div class="inner">
							<h3><?=$actividadestotales?></h3>

							<p>Actividades Registradas</p>
						</div>
						<div class="icon">
							<i class="ion ion-android-checkmark-circle"></i>
						</div>
							<a href="<?=base_url('superadmin/Dashboard/Actividades')?>" class="small-box-footer">Actividades <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-6">
						<!-- small box -->
						<div class="small-box bg-primary">
						<div class="inner">
							<h3><?=$usuariostotales?></h3>
							<p>Empleados Registrados</p>
						</div>
						<div class="icon">
							<i class="ion ion-android-people"></i>
						</div>
						<a href="<?=base_url('superadmin/Dashboard/Usuarios')?>" class="small-box-footer">Usuarios <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-6">
						<!-- small box -->
						<div class="small-box bg-warning">
						<div class="inner">
							<h3><?=$maquinastotales?></h3>
							<p>Maquinaria Registrada</p>
						</div>
						<div class="icon">
							<i class="ion ion-android-train"></i>
						</div>
						<a href="<?=base_url('superadmin/Dashboard/Maquinaria')?>" class="small-box-footer">Maquinaria <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<!-- ./col -->
				</div>

				<div class="card">
					<div class="card-header">
						<?php
						$numero_aleatorio = mt_rand(1, 10);

						if ($numero_aleatorio == 1) {
							?>
							<h3 class="card-title">Bienvenido a Nuestra Página Principal</h3>
							<?php
						} elseif ($numero_aleatorio == 2) {
							?>
							<h3 class="card-title">Inicio: Tu Puerta de Entrada</h3>
							<?php
						} elseif ($numero_aleatorio == 3) {
							?>
							<h3 class="card-title">Explora Nuestro Mundo desde Aquí</h3>
							<?php
						} elseif ($numero_aleatorio == 4) {
							?>
							<h3 class="card-title">Comienza Tu Viaje Aquí</h3>
							<?php
						} elseif ($numero_aleatorio == 5) {
							?>
							<h3 class="card-title">Página de Inicio: Tu Lugar de Partida</h3>
							<?php
						} elseif ($numero_aleatorio == 6) {
							?>
							<h3 class="card-title">¡Hola! Estás en Nuestro Inicio</h3>
							<?php
						} elseif ($numero_aleatorio == 7) {
							?>
							<h3 class="card-title">Bienvenido al Punto de Partida</h3>
							<?php
						} elseif ($numero_aleatorio == 8) {
							?>
							<h3 class="card-title">Donde Todo Comienza: Página de Inicio</h3>
							<?php
						} elseif ($numero_aleatorio == 9) {
							?>
							<h3 class="card-title">Inicio: Descubre Nuestro Contenido</h3>
							<?php
						} elseif ($numero_aleatorio == 10) {
							?>
							<h3 class="card-title">En Casa: Nuestra Página de Inicio</h3>
							<?php
						}
						?>
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
						<p>¡Excelente noticia! Te informamos que has iniciado sesión satisfactoriamente en nuestro programa. Ahora
							tienes acceso a una serie de funciones que te permitirán gestionar la información que tengas disponible.
						</p>
						<p>Estamos aquí para ayudarte en cada paso del proceso. Si tienes alguna pregunta o necesitas asistencia
							adicional, no dudes en ponerte en contacto con nuestro equipo de soporte. ¡Gracias por confiar en
							nosotros!</p>
					</div>
					<div class="card-footer">
						<h4><b><i><?=$session['rol']?></i></b></h4>
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

	<script src="http://localhost/AgroControl/assets/plugins/jquery/jquery.min.js"></script>
	<script src="http://localhost/AgroControl/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="http://localhost/AgroControl/assets/dist/js/adminlte.min.js"></script>
	<script src="http://localhost/AgroControl/assets/plugins/moment/moment.min.js"></script>

</body>

</html>
