<?php

require_once "../../../controlador/usuarioControlador.php";
require_once "../../../modelo/Usuario.php";

class Ajax{

    public function Borrar(){
		$resultado = new usuarioControlador();
		$respuesta = $resultado->eliminar();
	}
}


$ajax = new Ajax();
$ajax->Borrar();