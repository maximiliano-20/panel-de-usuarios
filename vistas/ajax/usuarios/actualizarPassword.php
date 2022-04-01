<?php

require_once "../../../controlador/usuarioControlador.php";
require_once "../../../modelo/Usuario.php";

class Ajax{

    public function Actualizar(){
		$resultado = new usuarioControlador();
		$respuesta = $resultado->actualizarPassword();
	}
}


$ajax = new Ajax();
$ajax->Actualizar();