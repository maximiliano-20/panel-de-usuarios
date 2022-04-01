<?php
require_once 'conexion.php';


class Rol{

    public function mostrar(){
        
    $consulta = "SELECT * FROM roles";
    $sql = Conectar::Conexion()->prepare($consulta);
    $sql->execute();
    return $resultado = $sql->fetchAll();
    }

    public function agregar($rol){
    $consulta = "INSERT INTO roles (rol) VALUES (:rol)";
    $sql=Conectar::Conexion()->prepare($consulta);
    $sql->bindParam(":rol",$rol);
    $respuesta = $sql->execute();
    }

    public function eliminar($id){
    $consulta="DELETE FROM roles WHERE id = :id ";
    $sql = Conectar::Conexion()->prepare($consulta);
    $sql->bindParam(':id',$id,PDO::PARAM_INT);
    $resultado = $sql->execute();
    }

    public function editar($id){
        $consulta = "SELECT * FROM roles WHERE id = :id";
        $sql = Conectar::Conexion()->prepare($consulta);
        $sql->bindParam(":id",$id);
        $sql->execute();
        return $resultado = $sql->fetchAll();

    }

    public function modificar($id,$rol){
        $consulta = "UPDATE roles SET rol = :rol WHERE id = :id";
        $sql= Conectar::Conexion()->prepare($consulta);
        $sql->bindParam(":id",$id);
        $sql->bindParam(":rol",$rol);
        $respuesta = $sql->execute();

    }
     
}
