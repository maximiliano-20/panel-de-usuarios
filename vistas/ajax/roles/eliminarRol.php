<?php

require_once "../../../controlador/RolControlador.php";
require_once "../../../modelo/Rol.php";

class AjaxRol{

    public function Eliminar(){
		$resultado = new rolControlador();
		$respuesta = $resultado->eliminarRol();
	}
}


$ajax = new AjaxRol();
$ajax->Eliminar();