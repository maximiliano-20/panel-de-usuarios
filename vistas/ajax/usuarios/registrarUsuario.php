<?php

require_once "../../../controlador/usuarioControlador.php";
require_once "../../../modelo/Usuario.php";

class Ajax{

    public function Registrar(){
		$resultado = new usuarioControlador();
		$respuesta = $resultado->registrarUsuario();
	}
}


$ajax = new Ajax();
$ajax->Registrar();