<?php
    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>
    <body>
    <div class="contenedor-form">
        <h1>Seleccionar temas</h1>
        <form action="favoritos.php" method="post">    
            <?php
            require("conexion.php");
            session_start();
            $user =  $_SESSION['id_usuario'];
            $obtienecategoria=$conn->prepare("SELECT * FROM categoria");
            $sqlcount=$conn->prepare("SELECT count(*) FROM categoria");
            $obtienecategoria->execute();
            $sqlcount->execute();
            $cantcateg=$sqlcount->fetch(PDO::FETCH_NUM);
            $numcateg=$cantcateg[0];
              
            $fa = [];
            $cat =[];
            $nom=[];
            $i=0;$i2=0;
        
            while ($row=$obtienecategoria->fetch(PDO::FETCH_ASSOC)){ 
               $cat[$i]=   $row['id_categoria'] ;
               $nom[$i] = $row['titulo'] ;
               $i++;
                
            }
            $fav=$conn->prepare("SELECT * FROM favorito where id_usuario = $user");   
            $fav->execute();
           while ($res=$fav->fetch(PDO::FETCH_ASSOC)){ 
            $fa[$i2]=   $res['id_categoria'] ;
            $i2++;
        } 
        
        $max = sizeof($cat);//saco la longitud del arreglo
        for($j = 0; $j < $max;$j++)
        {
          
            $clave = in_array("$cat[$j]", $fa, true);
          
  
           
          if($clave){
            echo "<h2><input checked disabled type=\"checkbox\" name=\"cbox[]\" value=".$cat[$j].">".$nom[$j]."</h2>";
            
          }else{
            echo "<h2><input type=\"checkbox\" name=\"cbox[]\" value=".$cat[$j].">".$nom[$j]."</h2>";
            
          }
        }
        
          
            
            
             $cont=1; while ($row=$obtienecategoria->fetch(PDO::FETCH_ASSOC)){    
                $valor = $row['id_categoria'];
             
               
                   // echo "<h2><input type=\"checkbox\" name=\"cbox$cont\" value=".$row["titulo"].">".$row["titulo"]."</h2>";$cont=$cont+1;
                 // este es el bueno  echo "<h2><input type=\"checkbox\" name=\"cbox[]\" value=".$row["id_categoria"].">".$row["titulo"]."</h2>";$cont=$cont+1;
                  // echo "input type=\"text\" name=\"id\"" 
                
           }?>
          
            <input type="submit" value="Guardar"  name="registrar" class="log-btn">
        </form>
        </div>
       
    </body>
</html>