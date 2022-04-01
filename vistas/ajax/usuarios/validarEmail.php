<?php

require_once "../../../controlador/usuarioControlador.php";
require_once "../../../modelo/Usuario.php";

class Ajax{

    public function Validar(){
		$resultado = new usuarioControlador();
		$respuesta = $resultado->validarEmail();
	}
} 


$ajax = new Ajax();
$ajax->Validar();