<aside class="main-sidebar sidebar-dark-light elevation-4">
    <a href="<?=base_url('superadmin/Dashboard/Inicio')?>" class="brand-link">
      <img src="http://localhost/AgroControl/assets/dist/img/LogotipoAgroControl_085246.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AgroControl</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="http://localhost/AgroControl/Uploads/<?=$session['imguser']?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="<?=base_url('superadmin/Dashboard/MiPerfil')?>" class="d-block"><?= explode(" ", $session['nombre'])[0]." ".explode(" ", $session['apellido'])[0] ?></a>
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
            <a href="<?=base_url('superadmin/Dashboard/Usuarios')?>" class="nav-link <?=($OptionSelected=='usuarios')? 'active':'' ?>">
              <i class="fa-solid fa-users"></i>
              <p>USUARIOS</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('superadmin/Dashboard/Proveedores') ?>" class="nav-link <?=($OptionSelected=='proveedores')? 'active':'' ?>">
              <i class="fa-solid fa-boxes-packing"></i>
              <p>PROVEEDORES</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('superadmin/Dashboard/Repuestos') ?>" class="nav-link <?=($OptionSelected=='repuestos')? 'active':'' ?>">
              <i class="fa-solid fa-toolbox"></i>
              <p>REPUESTOS</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('superadmin/Dashboard/Maquinaria') ?>" class="nav-link <?=($OptionSelected=='maquinaria')? 'active':'' ?>">
              <i class="fa-solid fa-tractor"></i>
              <p>MAQUINARIA</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('superadmin/Dashboard/Actividades') ?>" class="nav-link <?=($OptionSelected=='actividades')? 'active':'' ?>">
              <i class="fa-solid fa-list"></i>
              <p>ACTIVIDADES</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('superadmin/Dashboard/Asignaciones') ?>" class="nav-link <?=($OptionSelected=='asignaciones')? 'active':'' ?>">
              <i class="fa-solid fa-circle-check"></i>
              <p>ASIGNACIONES</p>
            </a>
          </li>
          
          <li class="nav-item bg-orange">
            <a href="<?=base_url('Start/cerrarSession')?>" class="nav-link">
              <i class="fa-solid fa-right-from-bracket"></i>
              <p>CERRAR SESION</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
</aside>