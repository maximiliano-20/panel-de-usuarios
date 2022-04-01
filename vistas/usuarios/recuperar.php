<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recuperar Contraseña</title>
  <link rel="stylesheet" href="<?=url?>vistas/modulos/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?=url?>vistas/modulos/plugins/fontawesome-free/css/all.min.css">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b class="text-secondary">Panel de Usuarios</b>
  </div> 
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Haz olvidado tu contraseña? Escribe tu email para 
      restablecer tu contraseña</p>

      <form id="formulario" action="../php/usuarios/recuperar-contraseña.php" method="post">
        <div class="input-group mb-3">
          <input type="email" name="usuario_email" class="form-control" placeholder="Ingrese Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Requerir nueva contraseña</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
     

      <p class="mt-3 mb-1">
        <a href="<?=url?>usuario/login">Inicia Sesion</a>
      </p>
      <p class="mb-0">
        <a href="<?=url?>usuario/vistaRegistro" class="text-center">Registrarse</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?=url?>vistas/modulos/plugins/jquery/jquery.min.js"></script>
<script src="<?=url?>vistas/modulos/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=url?>vistas/modulos/dist/js/adminlte.js"></script>
<script src="<?=url?>vistas/modulos/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<script type="text/javascript" src="<?=url?>vistas/modulos/plugins/sweetalert2/sweetalert2.all.js"></script>

<script type="module" src="<?=url?>vistas/js/recuperar.js"></script>



</body>
</html>
