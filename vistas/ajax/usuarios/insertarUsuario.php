<?php

require_once "../../../controlador/usuarioControlador.php";
require_once "../../../modelo/Usuario.php";

class Ajax{

    public function Insertar(){
		$resultado = new usuarioControlador();
		$respuesta = $resultado->insertarUsuario();
	}
}


$ajax = new Ajax();
$ajax->Insertar();