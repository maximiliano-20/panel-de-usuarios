<?php

require_once "../../../controlador/RolControlador.php";
require_once "../../../modelo/Rol.php";

class AjaxRol{

    public function Agregar(){
		$resultado = new rolControlador();
		$respuesta = $resultado->agregarRol();
	}
}


$ajax = new AjaxRol();
$ajax->Agregar();