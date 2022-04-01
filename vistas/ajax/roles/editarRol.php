<?php
require_once "../../../controlador/RolControlador.php";
require_once "../../../modelo/Rol.php";

class AjaxRol{
 
    public function Editar(){
		$resultado = new rolControlador();
		$respuesta = $resultado->editarRol();
	}
}


$ajax = new AjaxRol();
$ajax->Editar();