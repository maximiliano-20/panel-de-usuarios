<?php

require_once "../../../controlador/usuarioControlador.php";
require_once "../../../modelo/Usuario.php";

class Ajax{

    public function Modificar(){
		$resultado = new usuarioControlador();
		$respuesta = $resultado->modificarUsuario();
	}
} 


$ajax = new Ajax();
$ajax->Modificar();