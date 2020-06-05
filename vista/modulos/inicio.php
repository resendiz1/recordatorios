<?php
session_start();
session_destroy();
$get= new mvcControlador();
$get -> UpUser();
$get->inUser();
$get->inAdmin();
?>
<style>
  .wrapper {
    margin-top: 10px;
    margin-bottom: 20px;
  }

  .form-signin {
    max-width: 420px;
    padding: 30px 38px 66px;
    margin: 0 auto;
    background-color: #eee;
    border: 3px dotted rgba(0, 0, 0, 0.1);
  }

  .form-signin-heading {
    text-align: center;
    margin-bottom: 30px;
  }

  .form-control {
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px;
  }

  input[type="text"] {
    margin-bottom: 0px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
  }

  input[type="password"] {
    margin-bottom: 20px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }

  .colorgraph {
    height: 12px;
    border-top: 0;
    background: #c4e17f;
    border-radius: 5px;
  }
</style>
<nav class="navbar navbar-dark primary-color">
  <a class="navbar-brand text-white" id="reg" data-toggle="modal" data-target="#register"><i class="fas fa-user-plus" ></i> <strong>Registrarse</strong></a>
</nav>
<?php
if(isset($_GET["go"])){
  if($_GET["go"]=="fallo_ingreso"){
    echo'<div class="alert alert-danger h4 text-center" role="alert">
    ERROR AL INGRESAR
  </div>';
  }
  if($_GET["go"]=="user_add"){
    echo'<div class="alert alert-success h4 text-center" role="alert">
   USUARIO AGREGADO CON EXITO
  </div>'; 
  }
  if($_GET["go"]=="no_user"){
    echo'<div class="alert alert-danger h4 text-center" role="alert">
   NO SE AGREGO EL USUARIO
  </div>'; 
  }
}
?>

<br><br>
<div class="wrapper">
  <form method="post"  name="Login_Form" class="form-signin">
    <h3 class="form-signin-heading">INGRESAR</h3>
    <hr class="colorgraph"><br>
    <label for="Ingusuario"></label>
    <input type="text" class="form-control" name="user" id="Ingusuario" placeholder="Usuario" required="" autofocus="" />
    <br>
    <label for="Ingpassword"></label>
    <input type="password" class="form-control" name="pass" placeholder="Contraseña" id="Ingpassword" required="" />
    <br>
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="in_user">Entrar como usuario </button>
    <br>
    <button class="btn btn-lg btn-success btn-block" type="submit" name="in_admin"> Entrar como Admin. </button>
  </form>
</div>







<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" ><p class="h4 mb-2">CREAR NUEVO PERFIL</p></h5>
        <button type="button" class="close" data-dismiss="modal"  aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="text-center border border-light p-5" method="post" enctype="multipart/form-data">
            <input type="email" id="nom" class="form-control mb-4" name="nombre" placeholder="correo electrónico" required>
            <input type="number" id="edad" class="form-control mb-4" name="edad" placeholder="Edad" required>
            <div class="form-group">
              <input type="password" class="form-control" name="pass" placeholder="password">
            </div>
            <div class="form-group">
              <input type="file" class="form-control" name="imagen" id="file">
            </div>

            <button class="btn btn-success btn-block" type="submit" name="signUp">Guardar</button>
          </form>
      <div class="col-lg-12 " id="preview"></div>
      </div>
    </div>
  </div>
</div>








