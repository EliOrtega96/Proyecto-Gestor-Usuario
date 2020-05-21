<?php
 require_once('conexion.php');

 if(!empty($_POST)){  
     $cat = $_POST['categoria'];
     

     $query = $conn->prepare("SELECT p.id_publicacion,p.titulo,a.ruta,p.texto,c.titulo as categoria,u.nombre 
     from publicacion p 
     inner join categoria c on p.id_categoria = c.id_categoria 
     inner join 
     usuario u on u.id_usuario=p.id_usuario  inner join archivos a on a.publicacion=p.id_publicacion WHERE p.id_valoracion=1 AND c.titulo = '$cat'
     ");  

     $query->execute();
     

     $q2 = $conn->prepare("SELECT count(*) as total FROM publicacion  inner join categoria on publicacion.id_categoria = categoria.id_categoria where  categoria.titulo = '$cat' and publicacion.id_valoracion=1");
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
    <style>
    img{
    width: 500px;
    height: 400px;
    
    }
</style>
</head>
<body>

<div class="container">
         <?php 
         if(!isset($q2)){
          include("buscardor.php");
        }else{
        $total =$q2->fetch();
      if($total['total']<=0){
        require_once("buscardor.php"); 
            echo "No hay resultados de la busqueda";
        }else{
            while($res = $query->fetch()) { 
                require_once("buscardor.php"); 
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