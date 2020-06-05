<?php
require_once "conexion.php";

class Datos extends Conexion{

    public static function addUser($datos, $tabla){
        
        $stmt=Conexion::conectar()->prepare("INSERT INTO $tabla (titulo, descripcion, enlace, fecha_add, realizado, user_id_user) 
        VALUES (:titulo, :descripcion, :enlace, :fecha, :noo, :id)");

        $stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":enlace", $datos["enlace"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":noo", $datos["no"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);


        if($stmt->execute()){
            return "ok";
        }
        else{
            return var_dump($stmt);
        }

    }

    public static function UpUserModelo($datos, $tabla){
        $stmt=Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, edad, pass, img) 
        VALUES (:nombre, :edad, :pass, :imagen)");
        
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":pass", $datos["pass"], PDO::PARAM_STR);
        $stmt->bindParam(":edad", $datos["edad"], PDO::PARAM_STR);
        $stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_LOB);
        if($stmt->execute()){
            return "ok";
        }
        else{
            return "error";
        }
    }

    public static function listUserModelo($tabla){
        $stmt=Conexion::conectar()->prepare("SELECT nombre, edad, img FROM $tabla");

        $stmt->execute();
        return $stmt->fetchAll();

    }

    public static function inUserModelo($datos, $tabla){
        $stmt=Conexion::conectar()->prepare("SELECT id_user, nombre, pass FROM $tabla WHERE nombre =:nombre");

        $stmt->bindParam(":nombre", $datos["user"], PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetch();
    }
    public static function inAdminModelo($datos, $tabla){
        $stmt=Conexion::conectar()->prepare("SELECT id_admin, usuario, secrets FROM $tabla WHERE usuario =:nombre");

        $stmt->bindParam(":nombre", $datos["user"], PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetch();
    }

    public static function profileCabeceraModelo($id, $tabla){
        $stmt=Conexion::conectar()->prepare("SELECT nombre, edad, img FROM $tabla WHERE id_user = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetch();
    }
    static public function porRealizarModelo($id, $tabla){
        $stmt=Conexion::conectar()->prepare("SELECT id_voluntad, titulo, descripcion, enlace, fecha_add, user_id_user FROM $tabla WHERE :id = user_id_user and realizado='no' ");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll();
    }

    static public function realizadoUserModelo($id, $tabla){
        $stmt=Conexion::conectar()->prepare("SELECT titulo, fecha_add, descripcion, enlace, fecha_make FROM $tabla WHERE :id = user_id_user and realizado='si'");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();

    }

    static public function conteoHechosModelo($id,$si,$tabla){
        $stmt=Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE realizado=:si and user_id_user= :id");
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        $stmt->bindParam(":si",$si, PDO::PARAM_STR);
    
        $stmt->execute();
       return $stmt->fetch();
    }
    static public function conteoAddModelo($tabla){
        $stmt=Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla");

    
        $stmt->execute();
       return $stmt->fetch();  
    }
    static public function tareaRealizadaModelo($id, $fecha, $tabla){
        $si="si";
        $stmt=Conexion::conectar()->prepare("UPDATE $tabla SET fecha_make = :fecha, realizado= :si WHERE id_voluntad = :id");
        $stmt->bindParam(":si", $si, PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }
        else{
            return "error";
        }
    }


    
}


?>