<?php

require_once "../../../controlador/usuarioControlador.php";
require_once "../../../modelo/Usuario.php";

class Ajax{

    public function Login(){
		$resultado = new usuarioControlador();
		$respuesta = $resultado->iniciarSesion();
	}
}


$ajax = new Ajax();
$ajax->Login();