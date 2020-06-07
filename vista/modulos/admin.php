<?php
session_start();
if(!$_SESSION["admin"]){
  header("location:index.php?go=inicio");
  exit();
}
?>
<div class="container mt-3">
   <div class="card" style="background:#8083FF;">
     <div class="card-body">
       <div class="row">
         <div class="col-lg-9 mt-5">
           <h1 class="text-center text-white bold">VER USUARIOS</h1>
           <br>
           <h3 class="text-center text-white bold">Usuarios registrados: <strong><?php $c= new mvcControlador(); $c->conteoAdd(); ?></strong></h3>
         </div>
         <div class="col-lg-3">
           <h5 class="text-center text-white bold"><?php $f=new mvcControlador(); $f->fecha_out(); ?></h5>
           <a href="index.php?go=inicio" class="btn btn-sm btn-block  my-5"   style="background: #E83407;">
        <h6 class="text-white"> SALIR</h6>
      </a>
         </div>
       </div>
     </div>
   </div>







   <div class="card mt-1">
     <div class="card-body">
       <div class="tab-content" id="myTabContent">
      


           <section class="text-center mb-4">
             <div class="row wow fadeIn">

               <?php
                $r = new mvcControlador();
                $r->listUser();
                ?>


             </div>
           </section>

         </div>

       </div>
     </div>





 </div>