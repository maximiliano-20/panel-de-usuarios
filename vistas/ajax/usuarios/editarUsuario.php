<?php

require_once "../../../controlador/usuarioControlador.php";
require_once "../../../modelo/Usuario.php";

class Ajax{

    public function Editar(){
		$resultado = new usuarioControlador();
		$respuesta = $resultado->editarUsuario();
	}
}


$ajax = new Ajax();
$ajax->Editar();