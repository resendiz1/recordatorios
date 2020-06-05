<?php
class rutasPagina{

    public static function rutas($ruta){
if($ruta=="profile" || $ruta=="admin"){
    $modulo  ="vista/modulos/".$ruta.".php";
}

elseif($ruta=="fallo_ingreso"){
    $modulo="vista/modulos/inicio.php";
}
elseif($ruta=="user_add"){
    $modulo="vista/modulos/inicio.php";
}
elseif($ruta=="no_user"){
    $modulo="vista/modulos/inicio.php";
}
elseif($ruta=="realizado_ok"){
    $modulo="vista/modulos/profile.php";
}
elseif($ruta=="no_guardado"){
    $modulo="vista/modulos/profile.php";
}
elseif($ruta=="agregado"){
    $modulo="vista/modulos/profile.php";
}
elseif($ruta=="no_agregado"){
    $modulo="vista/modulos/profile.php";
}

else{
    $modulo="vista/modulos/inicio.php";
}

return $modulo;
    }
}

?>