
<?php
if(!$_SESSION['logueado'] == "ok"){
  header('Location:'.url);	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel de Usuarios</title>
  <link rel="stylesheet" href="<?=url?>vistas/modulos/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?=url?>vistas/modulos/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?=url?>vistas/modulos/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=url?>vistas/modulos/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=url?>vistas/modulos/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

<?php require_once 'vistas/assets/menu.php'; ?> 
<?php require_once 'vistas/assets/aside.php'; ?> 



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">USUARIOS</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
             
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                  <?php if($_SESSION['rol'] == "Admin") : ?>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-agregar-usuario">
                  Agregar
                </button>
                <?php endif ?>
              </div>

 
              <div class="card-body">
                <table id="admin"  class="table table-bordered table-hover">
                  <thead>
                    <tr>
                    
                      <th>Usuario</th>
                      <th>Email</th>
                      <th>Estado</th>
                      <th>Rol</th>
                      <th>Perfil</th>
                      <th id="acciones">Acciones</th>
                    </tr>
                  </thead>

                  <tbody id="usuarios">

                  </tbody>  
                   

                </table>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  
    <!-- /.content -->
  </div>



<div class="modal fade" id="modal-agregar-usuario">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Agregar Usuario</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST"  enctype="multipart/form-data" id="formulario">
                 <div class="input-group mb-3">
                   <div class="input-group-append">
                     <div class="input-group-text">
                       <span class="fas fa-user"></span>
                     </div>
                   </div>
                  <input type="text" name="usuario_nombre" id="usuario_nombre" class="form-control" placeholder="Ingrese el usuario">
                 </div>

                 <div class="input-group mb-3">
                   <div class="input-group-append">
                     <div class="input-group-text">
                       <span class="fas fa-envelope"></span>
                     </div>
                   </div>
                  <input type="text" name="usuario_email" id="usuario_email" class="form-control" placeholder="Ingrese el email">
                 </div>


                 <div class="input-group mb-3 input">
                   <div class="input-group-append">
                     <div class="input-group-text">
                       <span class="fas fa-key"></span>
                     </div>
                   </div>
                  <input type="password" name="usuario_password"
                   id="usuario_password" class="form-control" 
                   placeholder="Ingrese la contraseña">
                   
                  

                 </div>

                 <div class="input-group mb-3">
                   <div class="input-group-append">
                     <div class="input-group-text">
                       <span class="fas fa-users"></span>
                     </div>
                   </div>
                  <select  class="form-control " id="rol" name="rol">
                   
                  </select>
                 </div>
                
                  <div  class="input-group mb-3">
                   <div class="input-group-append">
                     <div class="input-group-text">
                       <span class="fas fa-users"></span>
                     </div>
                   </div>
                  <select class="form-control" id="usuario_estado" name="usuario_estado">
                    <option selected disabled=>Seleccione un Estado</option>
                    <option  value="ACTIVO">ACTIVO</option>
                    <option value="INACTIVO">INACTIVO</option>
                   
                  </select>
                 </div>



                  <div class="input-group mb-3">
                   <div class="input-group-append">
                     <div class="input-group-text">
                       <span class="fas fa-file"></span>
                     </div>
                   </div>
                  <input type="file" name="usuario_imagen" id="usuario_imagen" class="form-control">
 
                 </div>
                 <div class="imagen-nueva" style="text-align: center;">
                 <img class="img-fluid" id="nuevaFoto" style="width:100px" >
                </div>

               <div class="modal-footer justify-content-between">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 <button type="submit" class="btn btn-primary">Guardar Cambios</button>
               </div>

              </form>


            </div>
           
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      

<div class="modal fade" id="modal-editar-usuario">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar Usuario</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="<?=url?>usuario/modificarUsuario"  enctype="multipart/form-data" id="formularioEditar">
                 <input type="hidden" id="id" name="id" >
                 <div class="input-group mb-3">
                   <div class="input-group-append">
                     <div class="input-group-text">
                       <span class="fas fa-user"></span>
                     </div>
                   </div>
                  <input type="text" name="usuario_nombre" id="editarNombre" class="form-control" placeholder="Ingrese el usuario">
                 </div>

                 <div class="input-group mb-3">
                   <div class="input-group-append">
                     <div class="input-group-text">
                       <span class="fas fa-envelope"></span>
                     </div>
                   </div>
                  <input type="text" name="usuario_email" id="editarEmail" class="form-control" placeholder="Ingrese el email">
                 </div>


                 <div class="input-group mb-3">
                   <div class="input-group-append">
                     <div class="input-group-text">
                       <span class="fas fa-users"></span>
                     </div>
                   </div>
                  <select  class="form-control " id="editarRol" name="rol">
                    
                  </select>
                 </div>
                
                  <div  class="input-group mb-3">
                   <div class="input-group-append">
                     <div class="input-group-text">
                       <span class="fas fa-users"></span>
                     </div>
                   </div>
                  <select class="form-control" id="editarEstado" name="usuario_estado">
                    <option selected disabled=>Seleccione un Estado</option>
                    <option  value="ACTIVO">ACTIVO</option>
                    <option value="INACTIVO">INACTIVO</option>
                   
                  </select>
                 </div>



                  <div class="input-group mb-3">
                   <div class="input-group-append">
                     <div class="input-group-text">
                       <span class="fas fa-file"></span>
                     </div>
                   </div>
                  <input type="file" name="usuario_imagen" id="editarImagen" class="form-control">
 
                 </div>
                 <div class="imagen-nueva" style="text-align: center;">
                 <img class="img-fluid" id="fotoEditada" style="width:100px" >
                </div>

               <div class="modal-footer justify-content-between">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 <button type="submit" class="btn btn-primary">Guardar Cambios</button>
               </div>

              </form>


            </div>
           
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->





  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0-rc
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="<?=url?>vistas/modulos/plugins/jquery/jquery.min.js"></script>


<script type="module" src="<?=url?>vistas/js/crud_usuarios.js"></script>
<script src="<?=url?>vistas/js/selectRol.js"></script>



<script src="<?=url?>vistas/modulos/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>



<!-- AdminLTE App -->
<script src="<?=url?>vistas/modulos/dist/js/adminlte.js"></script>
<script src="<?=url?>vistas/modulos/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<script type="text/javascript" src="<?=url?>vistas/modulos/plugins/sweetalert2/sweetalert2.all.js"></script>

<script src="<?=url?>vistas/modulos/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=url?>vistas/modulos/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=url?>vistas/modulos/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=url?>vistas/modulos/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
</body>
</html>
