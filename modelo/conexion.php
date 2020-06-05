<?php
class Conexion{
    static public function conectar(){
        $cadena_conexion = new PDO("mysql:host=localhost;dbname=record","root","");
        return $cadena_conexion;
    }
}

?>