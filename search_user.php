<?php
 require_once('conexion.php');
 
 if(!empty($_POST)){  
     $usr = $_POST['usuario'];
     $query = $conn->prepare("SELECT p.id_publicacion,p.titulo,a.ruta,p.texto,c.titulo as categoria,u.nombre
     from publicacion p 
     inner join categoria c on p.id_categoria=c.id_categoria inner join usuario u on u.id_usuario =p.id_usuario inner join archivos a on a.publicacion=p.id_publicacion where u.nombre='$usr' and p.id_valoracion=1"); 
     $query->execute();
    $q2 = $conn->prepare("SELECT count(*) as total FROM publicacion  inner join usuario on publicacion.id_usuario = usuario.id_usuario where  usuario.nombre = '$usr' and publicacion.id_valoracion=1");
      $q2->execute();     
    }else {
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <style>
img{
    width: 500px;
    height: 400px;
}
</style>
</head>
<body>
<div class="container">
<div>
  <h1>Buscar</h1>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link " id="categoria-tab" data-toggle="tab" href="#categoria" role="tab" aria-controls="categoria" aria-selected="true">Categoria</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="usuario-tab" data-toggle="tab" href="#usuario" role="tab" aria-controls="usuario" aria-selected="false">texto</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Usuario</a>
  </li>
  <li class="nav-item">
    <a  class="nav-link "  href="registrado.php"   aria-selected="false">Inicio</a>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade" id="categoria" role="tabpanel" aria-labelledby="categoria-tab">
  categoria
  <form action="search_cat.php" method="post">
    <input type="text" name="categoria" id="">
    <input type="submit" value="Buscar">
  </form>
  
  </div>
  <div class="tab-pane fade" id="usuario" role="tabpanel" aria-labelledby="usuario-tab">
  texto
  <form action="search_text.php" method="post">
    <input type="text" name="texto" id="">
    <input type="submit" value="Buscar">
  </form>
  
  </div>
  <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab"> 
  usuario
  <form action="search_user.php" method="post">
    <input type="text" name="usuario" id="">
    <input type="submit" value="Buscar">
  </form>
   </div>

   
</div>

  </div>
         <?php 
        if(!isset($q2)){
          
        }
       else{
        $total =$q2->fetch();
        if($total['total']<=0){
          
              echo "No hay resultados de la busqueda";
          }else{
              while($res = $query->fetch()) { 
                
                  $img = $res['ruta'];
                  echo "<div> <center>".$res['titulo']."</div>"; 
                  
                  echo "<div> <center>  <img src='archivos/$img' >  </div>"; 
                  echo "<div> <center>".$res['categoria']."</div>"; 
                  echo "<div> <center>"."Created by: ".$res['nombre']."</div>"; 
                  echo "<hr>";  
              }
          }
       }
           
            ?>
</div>
</body>
</html>