<?php 
if(isset($_SESSION['ok'])){
  session_start();
}


?>
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

     <a href="#" class="brand-link">
      <img src="<?=url?>vistas/modulos/dist/img/guest.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Panel de Usuarios</span>
    </a>

    <div class="sidebar">

       <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       <div class="image">
          <img src="<?=url?>/imagenes/<?=$_SESSION['imagen']?>" class="img-circle elevation-2" alt="User Image">
        </div>
    
        <div class="info">
          <a href="#" class="d-block">
            <?=$_SESSION['nombre']?>
         
           </a> 
        </div>
      </div>

      <nav class="mt-2">

         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        

            <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php if($_SESSION['rol'] == "Admin") : ?>
              <li class="nav-item">
              <?php if($_SESSION['rol'] == "Admin") : ?>
                <a href="<?=url?>usuario/admin" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Listas de Usuarios</p>
                </a>
                <?php else : ?>
                  <a href="<?=url?>usuario/usuario" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Listas de Usuarios</p>
                </a>
                <?php endif?>
              </li>
             
            </ul>
          </li>
          <?php else : ?>
            <li class="nav-item">
                <a href="<?=url?>usuario/usuario" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Mi Perfil</p>
                </a>
              </li>
             
            </ul>
          </li>
          <?php endif ?>
          <?php if($_SESSION['rol'] == "Admin") : ?>
           <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Roles
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="<?=url?>rol/vistaRol" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Listas de Roles</p>
                </a>
              </li>
             
            </ul>
          </li>
        <?php endif ?>


           
         </ul>

      </nav>

    </div>
         
    <!-- /.sidebar -->
  </aside>
