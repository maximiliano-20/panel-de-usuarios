<?php

require_once 'parametros.php';
require_once 'autoload.php';


if(isset($_GET['controlador'])) {
    $nombre_controlador = $_GET['controlador'].'Controlador';
}elseif(!isset($_GET['controlador'])  && !isset($_GET['accion'])){
    $nombre_controlador = controlador_defecto;
}else {
    $error = new ErrorControlador();
    $error->Error404();
    exit();
}


if(class_exists($nombre_controlador)){
    $controlador = new $nombre_controlador();

    if(isset($_GET['accion']) && method_exists($controlador,$_GET['accion'])){
        $accion = $_GET['accion'];
        $controlador->$accion();
    }elseif(!isset($_GET['controlador'])  && !isset($_GET['accion'])){
        $default=accion_defecto;
		$controlador->$default();
    }
    else{
        $error = new ErrorControlador();
        $error->Error404();
    }
    

}else{
    $error = new ErrorControlador();
    $error->Error404();
}






?>

