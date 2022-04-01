<?php

require_once "../../../controlador/usuarioControlador.php";
require_once "../../../modelo/Usuario.php";

class Ajax{

    public function Listar(){
		$resultado = new usuarioControlador();
		$respuesta = $resultado->listar();
	}
	
} 


$ajax = new Ajax();
$ajax->Listar();