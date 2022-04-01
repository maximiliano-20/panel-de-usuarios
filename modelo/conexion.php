<?php

class Conectar{
    public static function Conexion(){
        $conexion = new PDO('mysql:host=localhost;dbname=administrador','root','');
        return $conexion;
    }
    
}
