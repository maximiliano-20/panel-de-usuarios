<?php
session_start();


class usuarioControlador{
      public function login(){
          require_once 'vistas/usuarios/login.php';
      }

      public function cerrarSesion(){
        session_destroy();
        header('Location:'.url);	
      }

      public function iniciarSesion(){
          if (isset($_POST)) {
            $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            $resultado = new Usuario();
            $respuesta = $resultado->login($usuario,$password);
            $verificar=password_verify($password, $respuesta['usuario_password']);
            
            (!$verificar) ? $mensaje['error'] = false : $mensaje["ok"] = true;
            
            ($respuesta['usuario_estado'] === "ACTIVO") ? $mensaje["activo"] = true :  $mensaje["activo"] = false;

            ($respuesta['rol'] === "Admin") ? $mensaje['rol'] = "admin" : $mensaje['rol'] = "usuario";

            $_SESSION['id'] = $respuesta['id'];
            $_SESSION['nombre'] = $respuesta['usuario_nombre'];
            $_SESSION['email'] = $respuesta['usuario_email'];
            $_SESSION['password'] = $respuesta['usuario_password'];
            $_SESSION['estado'] = $respuesta['usuario_estado'];
            $_SESSION['imagen'] = $respuesta['usuario_imagen'];
            $_SESSION['rol'] = $respuesta['rol'];
            $_SESSION['logueado'] = 'ok';

            echo json_encode($mensaje);


          }
      }

      public function usuario(){
        require_once 'vistas/usuarios/usuario.php';
      }

      public function admin(){
        require_once 'vistas/usuarios/admin.php';
      }



      public function listar(){
         $tipo_rol = $_SESSION['email'];
         $respuesta = new Usuario();
         $resultado = $respuesta->mostrar($tipo_rol);
         echo json_encode($resultado);
         
      }

      public function insertarUsuario(){
        $usuario_nombre = $_POST['usuario_nombre'];
        $usuario_email = $_POST['usuario_email'];
        $usuario_password = $_POST['usuario_password'];
        $rol_id = $_POST['rol'];
        $usuario_estado = isset($_POST['usuario_estado']) ? $_POST['usuario_estado'] : false;
        $usuario_imagen =  $_FILES['usuario_imagen'];
     
        $nombre_imagen = $usuario_imagen['name'];
        $tipo_imagen = $usuario_imagen['type']; 
        $carpeta_imagen = $usuario_imagen['tmp_name'];

        $errores = [];

  
       if (trim($usuario_nombre) == "" || trim($usuario_email) == "" || trim($usuario_password) == "" || $usuario_estado == "" || $nombre_imagen == "") {
          $errores['vacios'] = true;
       }

       if (!filter_var($usuario_email,FILTER_VALIDATE_EMAIL)) {
          $errores['errorEmail'] = true;
       }
 
 
       if ($tipo_imagen == "image/jpg" || $tipo_imagen == "image/png" || $tipo_imagen == "image/jpeg"){
          if (!is_dir("../../imagenes")) {
              mkdir('../../imagenes',0777);
          }
          move_uploaded_file($carpeta_imagen, '../../imagenes/'.$nombre_imagen);  
      }

      $validar = new Usuario();
      $email = $validar->mail($usuario_email);

      $password_segura = password_hash($usuario_password, PASSWORD_BCRYPT);
      $respuesta = new Usuario();
      if(count($errores) == 0 && $email == false){
        $resultado = $respuesta->insertar($usuario_nombre,$usuario_email,$password_segura,
        $rol_id,$usuario_estado,$usuario_imagen);
        $errores['ok'] = true;
      }else{
        $errores['ok'] = false;
      }
      
      echo json_encode($errores);


      }

      public function editarUsuario(){
        $id = isset($_POST['id']) ? $_POST['id'] : false;
        $respuesta = new Usuario();
        $resultado = $respuesta->editar($id);
        echo json_encode($resultado);

      }

      public function modificarUsuario(){
        if(isset($_POST)){
          $id = isset($_POST['id']) ? $_POST['id'] : false;
          $usuario_nombre = $_POST['usuario_nombre'];
          $usuario_email = $_POST['usuario_email'];
          $rol_id = isset($_POST['rol']) ? $_POST['rol'] : false;
          $usuario_estado = isset($_POST['usuario_estado']) ? $_POST['usuario_estado'] : false;
          $usuario_imagen = $_FILES['usuario_imagen'];
          $nombre_imagen = $usuario_imagen['name'];
          $tipo_imagen = $usuario_imagen['type']; 
          $carpeta_imagen = $usuario_imagen['tmp_name'];
          $errores = []; 

          if (trim($usuario_nombre) == "" || trim($usuario_email) == "") {
            $errores['vacios'] = true;
          }
  
          if (!filter_var($usuario_email,FILTER_VALIDATE_EMAIL)) {
            $errores['errorEmail'] = true;
          }

          if($tipo_imagen == "image/jpg" || $tipo_imagen == "image/png" ||
          $tipo_imagen == "image/jpeg"){
            move_uploaded_file($carpeta_imagen, '../../imagenes/'.$nombre_imagen);

          }

          $respuesta = new Usuario();
          if(count($errores) == 0){
            $resultado = $respuesta->modificar($id,$usuario_nombre,$usuario_email,$rol_id,
            $usuario_estado,$usuario_imagen);
            $errores['ok'] = true;
          }else{ 
            $errores['ok'] = false;
          }
    
          echo json_encode($errores);
          



        }
          
     

      }

      public function eliminar(){
        $id = isset($_POST['id']) ? $_POST['id'] : false;
        $respuesta = new Usuario();
        $resultado = $respuesta->borrar($id);
        echo json_encode($resultado);

      }

      public function validarEmail(){
        $usuario_email = isset($_POST['usuario_email']) ? $_POST['usuario_email'] : false;
        $respuesta = new Usuario();
        $resultado = $respuesta->mail($usuario_email);
        echo json_encode($resultado);
      }

      public function vistaRegistro(){
        require_once 'vistas/usuarios/registro.php';
      }

      public function registrarUsuario(){
        if(isset($_POST)){
        $usuario_nombre = isset($_POST['usuario_nombre']) ? $_POST['usuario_nombre'] : false;
        $usuario_email = isset($_POST['usuario_email']) ? $_POST['usuario_email'] : false;
        $usuario_password = isset($_POST['usuario_password']) ? $_POST['usuario_password'] : false;
        $usuario_imagen = $_FILES['usuario_imagen'];

        $rol_id = 2;
        $usuario_estado = "ACTIVO";      
        $nombre_imagen = $usuario_imagen['name'];
        $tipo_imagen = $usuario_imagen['type']; 
        $carpeta_imagen = $usuario_imagen['tmp_name'];
        $reg_password = "/^[a-zA-Z0-9]{6,30}+$/";
        $mensaje = [];

        (trim($usuario_nombre) == "" || trim($usuario_email) == "" || trim($usuario_password) == "" || $nombre_imagen == "") ?
        $mensaje['validarCampos'] = true :false;
         
        
        (!filter_var($usuario_email,FILTER_VALIDATE_EMAIL)) ?  $mensaje['errorEmail'] = true : false;

        (!preg_match($reg_password,$usuario_password)) ?  $mensaje['validarPassword'] = true : false;

        if ($tipo_imagen == "image/jpg" || $tipo_imagen == "image/png" || $tipo_imagen == "image/jpeg"){
          if (!is_dir("../../imagenes")) {
              mkdir('../../imagenes',0777);
          }
      
          move_uploaded_file($carpeta_imagen, '../../imagenes/'.$nombre_imagen); 
        } 

        $validar = new Usuario();
        $email = $validar->mail($usuario_email);

         
        $password_segura = password_hash($usuario_password, PASSWORD_BCRYPT);
        $respuesta = new Usuario();
       if(count($mensaje) == 0 && $email == false){
        $resultado = $respuesta->registrar($usuario_nombre,$usuario_email,
        $password_segura,$rol_id,$usuario_estado,$usuario_imagen);
        $mensaje['ok'] = true;
       }else{
        $mensaje['ok'] = false;
       }

       echo json_encode($mensaje);
         
        
        }
      
      
      
      }

      public function vistaRecuperar(){
        require_once 'vistas/usuarios/recuperar.php';
      }


      public function recuperarPassword(){
        $mensaje = [];
        $usuario_email = isset($_POST['usuario_email']) ? $_POST['usuario_email'] : false;
        $cabeceras = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $contenido = '<html>'.
	      '<head><title>Email con HTML</title></head>'.
	      '<body>
        <p>Para restablecer la contraseña has click en el link <a href="http://localhost/panel-de-usuarios/usuario/vistaResetear?email='.$usuario_email.'">Restablecer Contraseña</a>'.
	      '<hr>'.
	      '</body>'.
	      '</html>';
        $asunto_mensaje = "Restablecimiento de Contraseña";

    
        if (empty($usuario_email)) {
         $mensaje['error'] = true; 
        }

        $respuesta = new Usuario();
        $resultado = $respuesta->recuperar($usuario_email);
        if ($resultado) {
          $mensaje['existe'] = true;
          mail($usuario_email, $asunto_mensaje,$contenido,$cabeceras);
          $mensaje['enviado'] = true;
        }else {
          $mensaje['existe'] = false;
             
        }
        echo json_encode($mensaje);
      }

      

      public function vistaResetear(){
        require_once 'vistas/usuarios/resetear.php';
      }


      public function actualizarPassword(){
        $usuario_password = $_POST['usuario_password'];
        $usuario_email = $_POST['usuario_email'];
        $password_encriptada = password_hash($usuario_password,PASSWORD_BCRYPT);
        $validacion_password = "/^[a-zA-Z0-9]{6,30}+$/";
        $mensaje = array();

        if (empty($usuario_password)) {
          $mensaje['error'] = true;
      }elseif(!preg_match($validacion_password,$usuario_password)){
          $mensaje['validar'] = true;
      }else{
          $mensaje['error'] = false;
          $respuesta = new Usuario();
          $resultado = $respuesta->actualizar($usuario_email,$password_encriptada);
      }

      echo json_encode($mensaje);    

      
       


      }
      
     
      

}

