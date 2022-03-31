<?php
/*Controlador que llama a una vista 404 en caso de que no se encuentre la pagina */
class ErrorControlador{
    
    public function Error404(){
        require_once 'vistas/assets/404.php';
    }
}