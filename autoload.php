<?php

// Funcion que permite cargar todos los controladores y llamarlos
function cargarControladores($controlador){
    require_once 'controlador/'.$controlador.'.php';
}


spl_autoload_register('cargarControladores');