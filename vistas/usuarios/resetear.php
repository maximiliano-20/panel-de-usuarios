<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recuperar Contraseña</title>
  <link rel="stylesheet" href="<?=url?>vistas/modulos/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?=url?>vistas/modulos/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?=url?>dist/css/adminlte.min.css">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Panel de Usuarios</b>
  </div> 
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Restablecer Contraseña</p>
     
      
      <form id="formulario" action="<?=url?>usuario/actualizarPassword" method="post">
        <div class="input-group mb-3">
          <input type="hidden" name="usuario_email" id="email"  >
          <input type="password" name="usuario_password" id="password" class="form-control" placeholder="Ingrese una nueva contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Modificar Contraseña</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      
     

      <p class="mt-3 mb-1">
        <a href="<?=url?>usuario/login">Inicia Sesion</a>
      </p>
     
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<script type="module" src="<?=url?>vistas/js/actualizar-password.js"></script>


 
</body>
</html>
