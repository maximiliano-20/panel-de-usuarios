<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel de Usuarios</title>

  <link rel="stylesheet" href="<?=url?>vistas/modulos/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?=url?>vistas/modulos/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <!-- <div class="register-logo">
    <a href="../../index2.html"><b>Admin</b></a>
  </div> -->

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg text-dark">Registra un nuevo usuario</p>

      <form method="post" enctype="multipart/form-data" id="formulario">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="usuario_nombre" id="usuario_nombre" placeholder="Nombre de Usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="usuario_email" id="usuario_email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="usuario_password" id="usuario_password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <div class="input-group mb-3">
          <input type="file" class="form-control" name="usuario_imagen" id="usuario_imagen" >
         <div class="input-group-append">
           <div class="input-group-text">
             <span class="fas fa-file"></span>

           </div> 
         </div>
        </div>
        <div class="imagen-nueva" style="text-align: center;">
            <img class="img-fluid" id="nueva-foto">
        </div>
       

        <div class="row">
        
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">
            Registrarse</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

   

      <a href="<?=url?>usuario/login" class="text-center">Iniciar Sesion</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="<?=url?>vistas/modulos/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?=url?>vistas/modulos/plugins/sweetalert2/sweetalert2.all.js"></script>

<!-- Bootstrap 4 -->
<script src="<?=url?>vistas/modulos/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=url?>vistas/modulos/dist/js/adminlte.min.js"></script>
<script type="module" src="<?=url?>vistas/js/registro.js"></script>


<script type="text/javascript">
    
    let imagenInput = document.querySelector('#usuario_imagen');
    let nuevaImagen = document.querySelector('#nueva-foto')

    
    imagenInput.addEventListener('change', (e) =>{

        const datosImagen =  e.target.files[0];
        const { type } = datosImagen;

        if (type != 'image/jpeg' &&  type != 'image/png' ) {
             alert("No es una imagen");
             return;
        }

         let lector = new FileReader();
         lector.readAsDataURL(imagenInput.files[0]);
         
         lector.onload = () =>{
            nuevaImagen.setAttribute('src', lector.result);
            nuevaImagen.style.width = '100px';
            nuevaImagen.style.margin = 'auto';
            nuevaImagen.style.marginBottom = '10px';

         }
    });
    



    

</script>


</body>
</html>
