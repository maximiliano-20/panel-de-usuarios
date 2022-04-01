<?php

session_start();


class rolControlador
{
    public function vistaRol(){
        require_once 'vistas/roles/rol.php';
    } 

    public function selectRoles(){
        $respuesta = new Rol();
        $resultado = $respuesta->mostrar();
        echo json_encode($resultado);
    }

    public function agregarRol(){
        $rol = trim($_POST['rol']);
        $validacion_rol = "/^[a-zA-Z]{3,20}+$/";
        if (empty($rol)) {
            $mensaje['error'] = false;
         }else if(!preg_match($validacion_rol,$rol)){
            $mensaje['validar'] = true;
         }else {
            $mensaje['ok'] = true;
            $respuesta = new Rol();
            $resultado = $respuesta->agregar($rol);
         }
         
         
        echo json_encode($mensaje);
    }

    public function editarRol(){
        $id = $_POST['id'];
        $respuesta = new Rol();
        $resultado = $respuesta->editar($id);
        echo json_encode($resultado);

    } 

    public function modificarRol(){
        $id = $_POST['id'];
        $rol = trim($_POST['rol']);
        $validacion_rol = "/^[a-zA-Z]{3,20}+$/";
        $mensaje = [];

        if (empty($rol)) {
           $mensaje['error'] = false;
        }
        if(!preg_match($validacion_rol,$rol)){
           $mensaje['validar'] = true;
        }

        if(count($mensaje) === 0){
            $respuesta = new Rol();
            $resultado = $respuesta->modificar($id,$rol);
            $mensaje['ok'] = true;
        }else{
            $mensaje['ok'] = false;
        }
      
        echo json_encode($mensaje);

   
}



    public function eliminarRol(){
        $id = isset($_POST['id']) ? $_POST['id'] : false;
        $respuesta = new Rol();
        $resultado = $respuesta->eliminar($id);
        echo json_encode($resultado);


    }
}
