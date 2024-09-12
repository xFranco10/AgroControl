<?php
  $this->load->view('dashboard/superadmin/layoutsSuperAdmin/header');
?>
  <?php
    $dataSidebar['session']=$session;
    $dataSidebar['OptionSelected']='proveedores';
    
    $this->load->view('dashboard/superadmin/layoutsSuperAdmin/sidebar',$dataSidebar);
  ?>
  
  <?php
    if(isset($datorepetido)){
      ?>
        <script>
          Swal.fire({
            title: "ACTUALIZACION INCORRECTA",
            text: "Datos de proveedor repetidos",
            icon: "warning"
          });
        </script>
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
      <?php
    }
  ?>
		<div class="content-wrapper">
			<section class="content">
				<?php
				if (isset($proveedor)) {
					?>
					<div class="d-flex justify-content-center">
						<div class="contenedor py-2 text-center">
							<div class="py-2">
								<h3>EDITANDO PROVEEDOR (<b><?=$proveedor->nit?></b>)</h3>
								<h5><?=$proveedor->nombre_proveedor?></h5>
							</div>
							<form method="post"
								action="<?= base_url('superadmin/proveedores/ProveedoresController/ActualizarDatosProveedor'); ?>">
								<input type="hidden" name="id_proveedor" value="<?= $proveedor->id_proveedor; ?>">
								<div class="p-3">
									<h5><i class="fa-solid fa-barcode"></i> NIT</h5>
									<input class="form-control" type="text" name="nit" value="<?= $proveedor->nit; ?>" required>
								</div>
								<div class="p-3">
									<h5><i class="fa-solid fa-boxes-packing"></i> NOMBRE</h5>
									<input class="form-control" type="text" name="nombre" value="<?= $proveedor->nombre_proveedor; ?>" required>
								</div>
								<div class="p-3">
									<h5><i class="fa-solid fa-envelopes-bulk"></i> CODIGO POSTAL</h5>
									<input class="form-control" type="text" name="codpostal" value="<?= $proveedor->codpostal; ?>" required>
								</div>
								<div class="p-3">
									<h5><i class="fa-solid fa-location"></i> DIRECCION</h5>
									<input class="form-control" type="text" name="direccion" value="<?= $proveedor->direccion; ?>" required>
								</div>
								<div class="p-3">
									<h5><i class="fa-solid fa-phone"></i> TELEFONO</h5>
									<input class="form-control" type="number" name="telefono" value="<?= $proveedor->telefono; ?>" required>
								</div>
								<div class="p-3">
									<h5><i class="fa-solid fa-envelope"></i> EMAIL</h5>
									<input class="form-control" type="email" name="email" value="<?= $proveedor->email; ?>" required>
								</div>
								<div class="container d-grid gap-2 py-3">
									<input type="submit" class="btn btn-success" value="GUARDAR CAMBIOS">
									<a class="btn btn-dark" href="<?=base_url('superadmin/Dashboard/Proveedores')?>">REGRESAR A PROVEEDORES</a>
								</div>
							</form>
						</div>
					</div>
					<?php
				} elseif (isset($proveedor) == null) {
					?>
						<div class="pt-5">
							<h3 class="text-center py-2">EL ID NO FUE ENCONTRADO</h3>
							<div class="d-flex justify-content-center ">
							<img class="img img-fluid" src="http://localhost/AgroControl/assets/dist/img/search.png" alt="">
							</div>
						</div>
					<?php
				}
				?>
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

</body>

</html>
