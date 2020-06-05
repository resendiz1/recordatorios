<?php
$get = new mvcControlador();
$get->addUser();
$get->tareaRealizada();

session_start();
if(!$_SESSION["usuario"]){
  header("location:index.php?go=inicio");
  exit();
}

?>
   <div class="container mt-3">

<?php
$get = new mvcControlador();
$get -> profileCabecera();

if(isset($_GET["go"])){
  if($_GET["go"]=="realizado_ok"){
    echo'<div class="alert alert-success h4 text-center" role="alert">
    GUARDADO COMO REALIZADO
  </div>';
  }
  if($_GET["go"]=="no_guardado"){
    echo'<div class="alert alert-danger h4 text-center" role="alert">
    INTENTA DE NUEVO
  </div>';
  }
  if($_GET["go"]=="no_agregado"){
    echo'<div class="alert alert-danger h4 text-center" role="alert">
    INTENTA DE NUEVO
  </div>';
  }
  if($_GET["go"]=="agregado"){
    echo'<div class="alert alert-success h4 text-center" role="alert">
    AGREGADO!!
  </div>';
  }
}
?>




    <div class="card " >
      <div class="card-body h5">
        <ul class="nav nav-tabs " id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
              aria-selected="true">POR REALIZAR</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
              aria-selected="false">REALIZADAS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
              aria-selected="false">CREAR VOLUNTAD</a>
          </li>
        </ul>
      </div>
    </div>


    <div class="card mt-1">
      <div class="card-body">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <section class="text-center mb-4">
              <div class="row wow fadeIn">


<?php
$get = new mvcControlador();
$get -> porRealizar();
?>



              </div>
            </section>

          </div>

          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">



              <section class="text-center mb-4">
                  <div class="row wow fadeIn">


                  <?php
                  $get = new mvcControlador();
                  $get -> realizadoUser();
                  ?>

                  </div>
                </section>
    
              </div>









          <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

            <div class="row">

              <div class="col-lg-7 col-md-12">
                <form class="text-center border border-light p-5" method="post" >
                  <p class="h4 mb-4">CREAR NUEVA VOLUNTAD</p>
                  <input type="text" id="titulo" class="form-control mb-4" name="titulo" placeholder="Titulo" required>
                  <input type="hidden" id="id" class="form-control mb-4" value="<?php echo $_SESSION["usuario"];?>" name="id" value="2" placeholder="Titulo" required>
                  <div class="form-group">
                    <textarea type="text" class="form-control rounded-0" name="descripcion" id="descripcion" rows="3"
                      placeholder="Descripción" required></textarea>
                  </div>
                  <input type="text" id="enlace" class="form-control mb-4" name="enlace" placeholder="https://www...."
                    required>
                  <button class="btn btn-success btn-block" type="submit" name="add">Guardar</button>
                </form>
              </div>



              <div class="col-lg-5 col-md-12">
                <div class="card">
                  <div class="card-header text-center" id="titulop"></div>
                  <div class="view overlay" id="preview">
                    <a>
                      <div class="mask rgba-white-slight"></div>
                    </a>
                  </div>
                  <div class="card-body text-center">
                    <h5>
                      <strong>
                        <p id="descripcionp" class="dark-grey-text">.
                         
                        </p>
                        <a href="https://www.google.com" id="enlacep"></a>
                      </strong>
                    </h5>
                    <h4 class="font-weight-bold blue-text">
                      <strong id=link></strong>
                    </h4>
                  </div>
                  <div class="card-footer">

                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>




  </div>










