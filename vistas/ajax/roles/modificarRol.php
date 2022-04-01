<?php

require_once "../../../controlador/RolControlador.php";
require_once "../../../modelo/Rol.php";

class AjaxRol{

    public function Modificar(){
		$resultado = new rolControlador();
		$respuesta = $resultado->modificarRol();
	}
}


$ajax = new AjaxRol();
$ajax->Modificar();