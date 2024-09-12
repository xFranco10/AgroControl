<aside class="main-sidebar sidebar-dark-lime elevation-4">
    <a href="<?=base_url('empleados/Dashboard/Inicio')?>" class="brand-link">
      <img src="http://localhost/AgroControl/assets/dist/img/LogotipoAgroControl_085246.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AgroControl</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="http://localhost/AgroControl/Uploads/<?=$session['imguser']?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="<?=base_url('empleados/Dashboard/MiPerfil')?>" class="d-block"><?= explode(" ", $session['nombre'])[0]." ".explode(" ", $session['apellido'])[0] ?></a>
        </div>
      </div>

      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Buscar Modulos" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="<?= base_url('empleados/Dashboard/Asignaciones') ?>" class="nav-link <?=($OptionSelected=='asignaciones')? 'active':'' ?>">
              <i class="fa-solid fa-circle-check"></i>
              <p>MIS ASIGNACIONES</p>
            </a>
          </li>
          
          <li class="nav-item bg-light mt-3">
            <a href="<?=base_url('Start/cerrarSession')?>" class="nav-link">
              <i class="fa-solid fa-right-from-bracket"></i>
              <p>CERRAR SESION</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
</aside>