<?php
  $this->load->view('dashboard/superadmin/layoutsSuperAdmin/header');
?>
  <?php
    $dataSidebar['session']=$session;
    $dataSidebar['OptionSelected']='repuestos';
    
    $this->load->view('dashboard/superadmin/layoutsSuperAdmin/sidebar',$dataSidebar);
  ?>
  <?php
    if(isset($datorepetido)){
      ?>
        <script>
          Swal.fire({
            title: "NO SE ACTUALIZO",
            text: "Datos de repuesto repetidos",
            icon: "warning"
          });
        </script>
      <?php
    }elseif(isset($camposvacios)){
      ?>
        <script>
          Swal.fire({
            title: "ERROR EN DATOS",
            text: "Hay campos que estan vacios",
            icon: "warning"
          });
        </script>
      <?php
    }
  ?>

  <div class="content-wrapper">

    <section class="content">
        <?php
            if(isset($repuesto)){
                ?>
                <div class="d-flex justify-content-center">
                    <div class="contenedor py-2 text-center">
                        <div class="py-2">
                            <h3>EDITANDO REPUESTO (<b><?=$repuesto->codigo?></b>)</h3>
                            <h5><?=$repuesto->nombre_repuesto?></h5>
                        </div>
                        <form method="post" action="<?php echo base_url('superadmin/repuestos/RepuestosController/actualizarDates'); ?>">
                            <input type="hidden" name="id_repuesto" value="<?=$repuesto->id_repuesto?>">
                            <div class="p-3">
                                <h5><i class="fa-solid fa-barcode"></i> CODIGO</h5>
                                <input class="form-control" type="number" name="codigo" value="<?=$repuesto->codigo?>" required>
                            </div>

                            <div class="row p-3">
                                <div class="col-md-6">
                                    <h5><i class="fa-solid fa-toolbox"></i> NOMBRE</h5>
                                    <input class="form-control" type="text" name="nombre" value="<?=$repuesto->nombre_repuesto?>" required>
                                </div>
                                <div class="col-md-6">
                                    <h5><i class="fa-solid fa-list"></i> TIPO REPUESTO</h5>
                                    <select class="form-select" name="tipo_repuesto" id="">
                                        <?php
                                            if ($repuesto->tipo_repuesto=="Motor"){
                                            ?>
                                                <option value="<?=$repuesto->tipo_repuesto?>"><?=$repuesto->tipo_repuesto?></option>
                                                <option value="Transmision">Transmision</option>
                                                <option value="Suspension">Suspension</option>
                                                <option value="Frenos">Frenos</option>
                                                <option value="Electricos">Electricos</option>
                                                <option value="Carroceria">Carroceria</option>
                                                <option value="Neumaticos">Neumaticos</option>
                                                <option value="Herramientas/Taller">Herramientas/Taller</option>
                                                <?php
                                            }elseif($repuesto->tipo_repuesto=="Transmision"){
                                                ?>
                                                <option value="<?=$repuesto->tipo_repuesto?>"><?=$repuesto->tipo_repuesto?></option>
                                                <option value="Motor">Motor</option>
                                                <option value="Suspension">Suspension</option>
                                                <option value="Frenos">Frenos</option>
                                                <option value="Electricos">Electricos</option>
                                                <option value="Carroceria">Carroceria</option>
                                                <option value="Neumaticos">Neumaticos</option>
                                                <option value="Herramientas/Taller">Herramientas/Taller</option>
                                                <?php
                                            }elseif($repuesto->tipo_repuesto=="Suspension"){
                                                ?>
                                                <option value="<?=$repuesto->tipo_repuesto?>"><?=$repuesto->tipo_repuesto?></option>
                                                <option value="Motor">Motor</option>
                                                <option value="Transmision">Transmision</option>
                                                <option value="Frenos">Frenos</option>
                                                <option value="Electricos">Electricos</option>
                                                <option value="Carroceria">Carroceria</option>
                                                <option value="Neumaticos">Neumaticos</option>
                                                <option value="Herramientas/Taller">Herramientas/Taller</option>
                                                <?php
                                            }elseif($repuesto->tipo_repuesto=="Frenos"){
                                                ?>
                                                <option value="<?=$repuesto->tipo_repuesto?>"><?=$repuesto->tipo_repuesto?></option>
                                                <option value="Motor">Motor</option>
                                                <option value="Transmision">Transmision</option>
                                                <option value="Suspension">Suspension</option>
                                                <option value="Electricos">Electricos</option>
                                                <option value="Carroceria">Carroceria</option>
                                                <option value="Neumaticos">Neumaticos</option>
                                                <option value="Herramientas/Taller">Herramientas/Taller</option>
                                                <?php
                                            }elseif($repuesto->tipo_repuesto=="Electricos"){
                                                ?>
                                                <option value="<?=$repuesto->tipo_repuesto?>"><?=$repuesto->tipo_repuesto?></option>
                                                <option value="Motor">Motor</option>
                                                <option value="Transmision">Transmision</option>
                                                <option value="Suspension">Suspension</option>
                                                <option value="Frenos">Frenos</option>
                                                <option value="Carroceria">Carroceria</option>
                                                <option value="Neumaticos">Neumaticos</option>
                                                <option value="Herramientas/Taller">Herramientas/Taller</option>
                                                <?php
                                            }elseif($repuesto->tipo_repuesto=="Carroceria"){
                                                ?>
                                                <option value="<?=$repuesto->tipo_repuesto?>"><?=$repuesto->tipo_repuesto?></option>
                                                <option value="Motor">Motor</option>
                                                <option value="Transmision">Transmision</option>
                                                <option value="Suspension">Suspension</option>
                                                <option value="Frenos">Frenos</option>
                                                <option value="Electricos">Electricos</option>
                                                <option value="Neumaticos">Neumaticos</option>
                                                <option value="Herramientas/Taller">Herramientas/Taller</option>
                                                <?php
                                            }elseif($repuesto->tipo_repuesto=="Neumaticos"){
                                                ?>
                                                <option value="<?=$repuesto->tipo_repuesto?>"><?=$repuesto->tipo_repuesto?></option>
                                                <option value="Motor">Motor</option>
                                                <option value="Transmision">Transmision</option>
                                                <option value="Suspension">Suspension</option>
                                                <option value="Frenos">Frenos</option>
                                                <option value="Electricos">Electricos</option>
                                                <option value="Carroceria">Carroceria</option>
                                                <option value="Herramientas/Taller">Herramientas/Taller</option>
                                                <?php
                                            }elseif($repuesto->tipo_repuesto=="Herramientas/Taller"){
                                                ?>
                                                <option value="<?=$repuesto->tipo_repuesto?>"><?=$repuesto->tipo_repuesto?></option>
                                                <option value="Motor">Motor</option>
                                                <option value="Transmision">Transmision</option>
                                                <option value="Suspension">Suspension</option>
                                                <option value="Frenos">Frenos</option>
                                                <option value="Electricos">Electricos</option>
                                                <option value="Carroceria">Carroceria</option>
                                                <option value="Neumaticos">Neumaticos</option>
                                                <?php
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row p-3">
                                <div class="col-md-6">
                                    <h5><i class="fa-solid fa-arrow-up-wide-short"></i> CANTIDAD</h5>
                                    <input class="form-control" type="number" name="cantidad" value="<?= $repuesto->cantidad ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <h5><i class="fa-solid fa-dollar-sign"></i> PRECIO COMPRA</h5>
                                    <input class="form-control" type="number" name="precio_compra" value="<?=$repuesto->precio_compra ?>" required>
                                </div>
                            </div>
                        
                            <div class="p-3">
                                <h5><i class="fa-solid fa-circle-info"></i> DESCRIPCION</h5>
                                <textarea name="descripcion" class="form-control" cols="100%" rows="8" required><?=$repuesto->descripcion ?></textarea>
                            </div>
                                         
                            <div class="row p-3">
                                <div class="col-md-6">
                                    <select class="form-select" id="id_proveedor" name="id_proveedor">
                                        <?php
                                            if($repuesto->id_proveedor==null){
                                                ?>
                                                    <?php foreach ($proveedornull as $proveedor): ?>
                                                        <option value="<?=$proveedor->id_proveedor?>"><?=$proveedor->nombre_proveedor?></option>
                                                    <?php endforeach; ?>                                            
                                                <?php
                                            }else{
                                                
                                            }
                                        ?>
                                        <?php foreach ($proveedor_actual as $proveedor): ?>
                                            <option value="<?=$proveedor->id_proveedor?>"><?=$proveedor->nombre_proveedor?></option>
                                        <?php endforeach; ?>
                                        <?php foreach ($proveedor_diferente_actual as $proveedor): ?>
                                            <option value="<?=$proveedor->id_proveedor?>"><?=$proveedor->nombre_proveedor?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" name="estado">
                                        <?php if ($repuesto): ?>
                                            <?php if ($repuesto->estado_repuesto == "DISPONIBLE"): ?>
                                                <option value="<?=$repuesto->estado_repuesto?>"><?=$repuesto->estado_repuesto?></option>
                                                <option value="NO DISPONIBLE">NO DISPONIBLE</option>
                                                <option value="PEDIDO">PEDIDO</option>
                                            <?php elseif ($repuesto->estado_repuesto == "NO DISPONIBLE"): ?>
                                                <option value="<?=$repuesto->estado_repuesto?>"><?=$repuesto->estado_repuesto?></option>
                                                <option value="DISPONIBLE">DISPONIBLE</option>
                                                <option value="PEDIDO">PEDIDO</option>
                                            <?php elseif ($repuesto->estado_repuesto == "PEDIDO"): ?>
                                                <option value="<?=$repuesto->estado_repuesto?>"><?=$repuesto->estado_repuesto?></option>
                                                <option value="DISPONIBLE">DISPONIBLE</option>
                                                <option value="NO DISPONIBLE">NO DISPONIBLE</option>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="container d-grid gap-2 py-3">
                                <input type="submit" class="btn btn-success" value="GUARDAR CAMBIOS">
                                <a class="btn btn-dark" href="<?=base_url('superadmin/Dashboard/Repuestos')?>">REGRESAR A REPUESTOS</a>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
            }elseif(isset($repuesto)==null){
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
