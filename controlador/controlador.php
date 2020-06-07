<?php
ob_start();
class mvcControlador
{


    //FUNCIONALIDAD DE LA PAGINA (RUTAS Y OTROS METODOS )
    public function plantilla()
    {
        include "vista/template.php";
    }




    public function inUser()
    {
        if (isset($_POST["in_user"])) {
            $datos = array(
                "user" => $_POST["user"],
                "pass" => $_POST["pass"]
            );
            $respuesta = Datos::inUserModelo($datos, "usuario");

            if ($respuesta["nombre"] == $_POST["user"] && $respuesta["pass"] == $_POST["pass"]) {
                session_start();
                $_SESSION["usuario"] = $respuesta["id_user"];
                header("location:index.php?go=profile");
                
            } else {
                header("location:index.php?go=fallo_ingreso");
                ob_end_flush();
                
            }
        }
    }

    public function inAdmin(){
      if(isset($_POST["in_admin"])){
        $datos=array("user"=>$_POST["user"],
                     "pass"=>$_POST["pass"]);
                     $respuesta = Datos::inAdminModelo($datos, "admin");
                     if ($respuesta["usuario"] == $_POST["user"] && $respuesta["secrets"] == $_POST["pass"]) {
                      session_start();
                      $_SESSION["admin"] = $respuesta["id_admin"];
                      header("location:index.php?go=admin");
                      
                  } else {
                      header("location:index.php?go=fallo_ingreso");
                      ob_end_flush();
                      
                  }
      }
    }

    public  function rutasControlador()
    {
        if (isset($_GET["go"])) {
            $ruta = $_GET["go"];
        } else {
            $ruta = "index";
        }
        $respuesta = rutasPagina::rutas($ruta);
        include $respuesta;
    }

    public function fecha()
    {
        date_default_timezone_set('America/Mexico_City');
        $dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        return $dias[date('w')] . " " . date('d') . " de " . $meses[date('n') - 1] . " del " . date('Y');
    }
    public function fecha_out()
    {
        date_default_timezone_set('America/Mexico_City');
        $dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        echo $dias[date('w')] . " " . date('d') . " de " . $meses[date('n') - 1] . " del " . date('Y');
    }
    //INTERACCIONES DE LA VISTA CON EL CONTROLADOR

    public function addUser()
    {
        if (isset($_POST["add"])) {
            $fecha = mvcControlador::fecha();
            $datos = array(
                "titulo" => $_POST["titulo"],
                "descripcion" => $_POST["descripcion"],
                "enlace" => $_POST["enlace"],
                "id" => $_POST["id"],
                "no" => "no",
                "fecha" => $fecha
            );

            $respuesta = Datos::addUser($datos, "voluntades");
            if ($respuesta == "ok") {
                header("location:index.php?go=agregado");
            } else {
                header("location:index.php?go=no_agregado");
            }
        }
    }



    public function UpUser()
    {
        if (isset($_POST["signUp"])) {
            if (
                $_FILES['imagen']['type'] != "image/jpg" &&
                $_FILES['imagen']['type'] != "image/png" &&
                $_FILES['imagen']['type'] != "image/gif" &&
                $_FILES['imagen']['type'] != "image/jpeg" &&
                $_FILES['imagen']['type'] != "image/bmp"
            ) {
                header("location:index.php?go=no_imagen");
            } else {
                if ($_FILES['imagen']['size'] > 1000000) {

                    header("location:index.php?go=sobre_peso");
                } else {
                    $carga_ruta = ($_FILES['imagen']['tmp_name']);
                    $imagen = fopen($carga_ruta, 'rb');

                    $datos = array(
                        "nombre" => $_POST["nombre"],
                        "edad" => $_POST["edad"],
                        "pass" => $_POST["pass"],
                        "imagen" => $imagen
                    );

                    $respuesta = Datos::UpUserModelo($datos, "usuario");
                    if ($respuesta == "ok") {
                        header("location:index.php?go=user_add");
                    } else {
                        header("location:index.php?go=no_user");
                    }
                }
            }
        }
    }



    public function listUser()
    {

        $respuesta = Datos::listUserModelo("usuario");
        foreach ($respuesta as $row => $item) {
            echo '
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card">
                <div class="card-header text-center">' . $item["nombre"] . ' </div>
                <div class="view overlay" id="preview">
                  <a>
                    <div class="mask rgba-white-slight"></div>
                  </a>
                </div>
                <div class="card-body text-center">
                  <div class="col-lg-12 ">
                    <center>
                      <img
                        src="data:image/jpg;base64,' . base64_encode($item["img"]) . '"
                        class="rounded-circle img-fluid"
                        style="height:235px; cursor:pointer; border:10px solid #39B305;" alt="">
                      <h5> <strong> EDAD:' . $item["edad"] . '</strong> </h5>
                    </center>
                  </div>
                </div>

              </div>
        </div>
            ';
        }
    }

    public function porRealizar(){
      if(isset($_SESSION["usuario"])){
          $id=$_SESSION["usuario"];

          $respuesta = Datos::porRealizarModelo($id,"voluntades");
          if(!$respuesta){
            echo'
            <div class="col-12 justify-content-center">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQXOIecvtvIqPZ6q81cfBzJTg61EMDPj60r1qFQ-ZTjf8_NCNTO" class="img-fluid" alt="">
            </div>
            ';
          }
          else{
          foreach ($respuesta as $row => $item) {
  echo'
  <div class="col-lg-6 col-md-6 mb-4">
  <div class="card">
    <div class="card-header h5" style="background:#8083FF;">'.$item["titulo"].'
    </div>
    <div class="card-body text-center">
      <p class="grey-text">
        <h5>'.$item["fecha_add"].'</h5>
      </p>
      <h5>
        <strong>
          <p class="dark-grey-text">'.$item["descripcion"].'
          </p>
        <a href="'.$item["enlace"].'" >'.$item["enlace"].'</a>
        </strong>
      </h5>
    </div>
    
    <div class="card-footer font-bold h5">
      <button class="btn btn-sm btn-block btn-success" data-toggle="modal" data-target="#ee'.$item["id_voluntad"].'" ><span class="h5" >REALIZADO</span></button>
    </div>
  </div>
  </div>




  <div class="modal fade" id="ee'.$item["id_voluntad"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><p class="h4 mb-2">CONFIRMAR REALIZACIÓN</p></h5>
        <button type="button" class="close" data-dismiss="modal"  aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="text-center border border-light p-5" method="post" >
          <input type="hidden" name="id_make" value="'.$item["id_voluntad"].'">
            <div class="form-group">
            <img class="img-fluid" src="https://cdn140.picsart.com/300513322048211.png?r1024x1024"  alt="">
            </div>
            <br>
            
            <button class="btn btn-success btn-block" type="submit" name="realizado"><strong>C O N F I R M O </strong></button>
          </form>
      <div class="col-lg-12 " id="preview"></div>
      </div>
    </div>
  </div>
</div>
 
  ';
  }
      }
    }
  }


  public function realizadoUser(){
    if(isset($_SESSION["usuario"])){
      $id=$_SESSION["usuario"];

      $respuesta=Datos::realizadoUserModelo($id, "voluntades");
      foreach($respuesta as $row  =>$item ){
        echo'
        <div class="col-lg-6 col-md-6 mb-4">
        <div class="card">
          <div class="card-header h5">'.$item["titulo"].'
          </div>
          <div class="card-body text-center">
            <p class="grey-text">
              <h5><strong>Programado: </strong>'.$item["fecha_add"].'</h5>
            </p>
            <h5>
              <strong>
                <p class="dark-grey-text">
                 '.$item["descripcion"].'
                </p>
                <br>
                <p>Apoyado por: </p>
                <a href="'.$item["enlace"].'" target="_blank">'.$item["enlace"].'</a>
              </strong>
            </h5>
          </div>
          <div class="card-footer font-bold h5">
              <h5>Hecho el : '.$item["fecha_make"].'</h5>
          </div>
        </div>
      </div>             
        ';
      }
    }
  }



  public function tareaRealizada(){
    if(isset($_POST["realizado"])){

      $id = $_POST["id_make"];
      $fecha=mvcControlador::fecha();

      $respuesta = Datos::tareaRealizadaModelo($id, $fecha, "voluntades");
      if($respuesta=="ok"){
        header("location:index.php?go=realizado_ok");
      }
      else{
        header("location:index.php?go=no_guardado");
      }

    }
  }

  public function conteoHechos(){
    if(isset($_SESSION["usuario"])){
      $id= $_SESSION["usuario"];
      $si="si";

      $respuesta=Datos::conteoHechosModelo($id,$si,"voluntades");
      return $respuesta[0];

      }
    }
  
    public function conteoAdd(){
      
            $respuesta=Datos::conteoAddModelo("usuario");

          echo $respuesta[0];
      
    }






    public function profileCabecera(){
        if(isset($_SESSION["usuario"])){
            $id=$_SESSION["usuario"];
            $respuesta=Datos::profileCabeceraModelo($id,"usuario");           
echo'
<div class="card" style="background:#8083FF;">
<div class="card-body">
  <div class="row">
    <div class="col-lg-3 ">
      <center>
        <img
          src="data:image/jpg;base64,'.base64_encode($respuesta["img"]).'"
          class="rounded-circle img-fluid " style="height:235px; cursor:pointer; border:10px solid #39B305;"
          alt="">
      </center>
    </div>
    <div class="col-lg-6 mt-5">
      <h1 class="text-center text-white bold">'.$respuesta["nombre"].'</h1>
      <br>
      <h3 class="text-center text-white bold">Voluntades realizadas: <strong>'.$w = mvcControlador::conteoHechos().'</strong></h3>
    </div>
    <div class="col-lg-3">
      <h5 class="text-center text-white bold">'.$r = mvcControlador::fecha().'</h5>
      <a href="index.php?go=inicio" class="btn btn-sm btn-block  my-5"   style="background: #E83407;">
        <h6 class="text-white"> SALIR</h6>
      </a>
    </div>
  </div>
</div>
</div>

';
            }
        }
    























}
