<?php

require_once 'conexion.php';



class Usuario{
    public function login($usuario,$password){
        $consulta = "SELECT u.id ,u.usuario_nombre ,u.usuario_email, u.usuario_password,
        u.usuario_estado,u.usuario_imagen, r.rol
        FROM usuarios u
        INNER JOIN roles r ON u.rol_id = r.id WHERE
        u.usuario_nombre = '$usuario'";

       $sql=Conectar::Conexion()->prepare($consulta);
       $sql->bindParam(":usuario_nombre",$usuario,PDO::PARAM_STR);
       $sql->bindParam(":usuario_password",$password,PDO::PARAM_STR);
       $sql->execute();
       return $resultado = $sql->fetch();

    }

    public function mostrar($tipo_rol){
        if ($_SESSION['rol'] === 'Admin') {
            $consulta = "SELECT u.id ,u.usuario_nombre ,u.usuario_email, u.usuario_password,
            u.usuario_estado,u.usuario_imagen, r.rol
            FROM usuarios u
            INNER JOIN roles r ON u.rol_id = r.id";
        
         }else{ 
            $consulta ="SELECT u.id ,u.usuario_nombre ,u.usuario_email, u.usuario_password,
            u.usuario_estado,u.usuario_imagen, r.rol
            FROM usuarios u
            INNER JOIN roles r ON u.rol_id = r.id HAVING u.usuario_email = '$tipo_rol'";
         }
        $sql=Conectar::Conexion()->prepare($consulta);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function insertar($usuario_nombre,$usuario_email,
    $password_segura,$rol_id,$usuario_estado,$usuario_imagen){

         $consulta = "INSERT INTO usuarios (rol_id,usuario_nombre,usuario_email,usuario_password,usuario_estado,usuario_imagen)
                      VALUES (:rol_id,:usuario_nombre,:usuario_email,:usuario_password,:usuario_estado,:usuario_imagen)";
         $sql = Conectar::Conexion()->prepare($consulta);
         $sql->bindParam(":rol_id",$rol_id,PDO::PARAM_STR);
         $sql->bindParam(":usuario_nombre",$usuario_nombre,PDO::PARAM_STR);
         $sql->bindParam(":usuario_email",$usuario_email,PDO::PARAM_STR);
         $sql->bindParam(":usuario_password",$password_segura,PDO::PARAM_STR);
         $sql->bindParam(":usuario_estado",$usuario_estado,PDO::PARAM_STR);
         $sql->bindParam(":usuario_imagen",$usuario_imagen['name'],PDO::PARAM_STR);
         return $respuesta = $sql->execute();    
          
    }


    public function editar($id){
        $consulta = "SELECT u.id,u.rol_id ,u.usuario_nombre ,u.usuario_email, u.usuario_password,
        u.usuario_estado,u.usuario_imagen,r.rol
        FROM usuarios u
        INNER JOIN roles r ON u.rol_id = r.id WHERE u.id = $id";

        $sql = Conectar::Conexion()->prepare($consulta);
        $sql->bindParam(":id",$id);
        $sql->execute();
        return $resultado = $sql->fetchAll();

    }

    public function modificar($id,$usuario_nombre,$usuario_email,$rol_id,
    $usuario_estado,$usuario_imagen){

        if ($usuario_imagen['tmp_name'] === "") {
            $consulta = "UPDATE usuarios SET rol_id = :rol_id, usuario_nombre = :usuario_nombre ,usuario_email = :usuario_email,
                     usuario_estado = :usuario_estado WHERE id=:id ";
            $sql = Conectar::Conexion()->prepare($consulta);
            $sql->bindParam(':id',$id);
            $sql->bindParam(":rol_id",$rol_id,PDO::PARAM_STR);
            $sql->bindParam(":usuario_nombre",$usuario_nombre,PDO::PARAM_STR);
            $sql->bindParam(":usuario_email",$usuario_email,PDO::PARAM_STR);
            $sql->bindParam(":usuario_estado",$usuario_estado,PDO::PARAM_STR);
            return $resultado = $sql->execute();
           
         
        }else{
            $consulta = "UPDATE usuarios SET rol_id = :rol_id, usuario_nombre = :usuario_nombre ,usuario_email = :usuario_email,
            usuario_estado = :usuario_estado,usuario_imagen = :usuario_imagen WHERE id=:id ";
            $sql = Conectar::Conexion()->prepare($consulta);
            $sql->bindParam(':id',$id);
            $sql->bindParam(":rol_id",$rol_id,PDO::PARAM_STR);
            $sql->bindParam(":usuario_nombre",$usuario_nombre,PDO::PARAM_STR);
            $sql->bindParam(":usuario_email",$usuario_email,PDO::PARAM_STR);
            $sql->bindParam(":usuario_estado",$usuario_estado,PDO::PARAM_STR);
            $sql->bindParam(":usuario_imagen",$usuario_imagen['name'],PDO::PARAM_STR);
            return $resultado = $sql->execute();
            
        }
        
        



    }

    public function borrar($id){
        $consulta="DELETE FROM usuarios WHERE id = $id ";
        $sql = Conectar::Conexion()->prepare($consulta);
        $sql->bindParam(':id',$id,PDO::PARAM_INT);
        return $resultado = $sql->execute();
    }

    public function mail($usuario_email){
        $consulta = "SELECT * FROM usuarios WHERE usuario_email = :usuario_email";
        $sql=Conectar::Conexion()->prepare($consulta);
        $sql->bindParam(":usuario_email",$usuario_email);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return true; 
        }else{
            return false;
        }
        
        return $respuesta = $sql->fetchAll();
        
    }

    public function registrar($usuario_nombre,$usuario_email,
    $password_segura,$rol_id,$usuario_estado,$usuario_imagen){
         $consulta = "INSERT INTO usuarios (rol_id,usuario_nombre,usuario_email,usuario_password,usuario_estado,usuario_imagen)
                       VALUES (:rol_id,:usuario_nombre,:usuario_email,:usuario_password,:usuario_estado,:usuario_imagen)";        
            $sql =Conectar::Conexion()->prepare($consulta);
            $sql->bindParam(":rol_id",$rol_id,PDO::PARAM_STR);
            $sql->bindParam(":usuario_nombre",$usuario_nombre,PDO::PARAM_STR);
            $sql->bindParam(":usuario_email",$usuario_email,PDO::PARAM_STR);
            $sql->bindParam(":usuario_password",$password_segura,PDO::PARAM_STR);
            $sql->bindParam(":usuario_estado",$usuario_estado,PDO::PARAM_STR);
            $sql->bindParam(":usuario_imagen",$usuario_imagen['name'],PDO::PARAM_STR);
            return $respuesta = $sql->execute();         
    }

    public function recuperar($usuario_email){
        $consulta = "SELECT * FROM usuarios WHERE usuario_email = :usuario_email";
        $sql=Conectar::Conexion()->prepare($consulta);
        $sql->bindParam(":usuario_email",$usuario_email);
        $sql->execute();
        return $respuesta = $sql->fetchAll();
    }

    
    public function actualizar($usuario_email,$password_encriptada){
          $consulta = "UPDATE usuarios SET usuario_password = :usuario_password WHERE usuario_email=:usuario_email ";
          $sql = Conectar::Conexion() -> prepare($consulta);
          $sql->bindParam(":usuario_email",$usuario_email,PDO::PARAM_STR);
          $sql->bindParam(":usuario_password",$password_encriptada,PDO::PARAM_STR);
          return $resultado = $sql->execute();
         
    } 

    

    
}
