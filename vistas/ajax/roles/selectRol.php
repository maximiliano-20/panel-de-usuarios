<?php

require_once "../../../controlador/RolControlador.php";
require_once "../../../modelo/Rol.php";

class Ajax{

    public function Mostrar(){
		$resultado = new rolControlador();
		$respuesta = $resultado->selectRoles();
		
	}
}


$ajax = new Ajax();
$ajax->Mostrar(); 