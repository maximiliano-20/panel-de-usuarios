<?php

require_once "../../../controlador/usuarioControlador.php";
require_once "../../../modelo/Usuario.php";

class Ajax{

    public function Recuperar(){
		$resultado = new usuarioControlador();
		$respuesta = $resultado->recuperarPassword();
	}
}


$ajax = new Ajax();
$ajax->Recuperar();