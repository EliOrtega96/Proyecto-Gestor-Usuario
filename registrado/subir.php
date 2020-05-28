<!-- CREO ISABEL -->
<?php
ob_start();
session_start();
if(!isset($_SESSION['logueado']) && $_SESSION['logueado'] == FALSE) {
  header("Location: index.php");
}

include "functions.php";

?>
<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>RED SOCIAL</title>    
    <meta charset="UTF-8">
    <meta name="title" content="Photogram">
    <meta name="description" content="Photogram">    
    <link href="../css/style.css" rel="stylesheet" type="text/css"/>   
    <link href="../css/instagram.css" rel="stylesheet" type="text/css"/>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 

    <script type="text/javascript">
    $(window).load(function(){
     $(function() {
      $('#file-input').change(function(e) {
          addImage(e); 
         });

         function addImage(e){
          var file = e.target.files[0],
          imageType = /image.*/;
        
          if (!file.type.match(imageType))
           return;
      
          var reader = new FileReader();
          reader.onload = fileOnload;
          reader.readAsDataURL(file);
         }
      
         function fileOnload(e) {
          var result=e.target.result;
          $('#imgSalida').attr("src",result);
         }
        });
      });
    </script>

    <script>
      function capturar() { //aplica el filtro
            var resultado="";
     
            var porNombre=document.getElementsByName("filter");
            for(var i=0;i<porNombre.length;i++)
            {
                if(porNombre[i].checked)
                    resultado=porNombre[i].value;
            }

        var elemento = document.getElementById("resultado");
        if (elemento.className == "") {
          elemento.className = resultado;
          elemento.width = "600";
        }else {
          elemento.className = resultado;
          elemento.width = "600";
        }
    }
    </script>
  </head>  

<?php include "header2.php";
?>

<form action="" method="post" enctype="multipart/form-data"> <!-- captura los datos de la publicacion -->
  <body > 
  <!--captura el titulo-->
  <div style="float: left; clear: both; margin-top: 30px; margin-bottom: 30px; margin-left: 24%;">
      <textarea rows="3" cols="50%" name="titulo" placeholder="Título de tu publicación"></textarea>
      <textarea rows="6" cols="100%" name="descripcion" placeholder="Descripción de tu publicación"></textarea>
  </div>

  <!--elagir categoria -->
  <div style="float: left; clear: both; margin-top: 30px; margin-bottom: 30px; margin-left: 24%;">
    <select name = "categoria">
      <option> -- SELECCIONAR CATEGORIA -- </option>
        <?php
          require "../conexion.php";
          $sqlCat = $conn->prepare('SELECT titulo FROM categoria');
          $sqlCat->execute();

          while($rowCAT = $sqlCat->fetch()){
            echo "<option>".$rowCAT['titulo']."</option>";
          }
        ?>
    </select>
  </div>
  <!-- sube imagen -->
  <div class="hl-icon" style="margin-left: 49%;">
    <div class="image-upload">
        <label for="file-input">
          <img src="../img/icons/mas.png" width="50" title ="Sube una foto ó video" >
        </label>
        <input id="file-input" type="file" name="file-input" hidden="" />
    </div>
  </div>

  <div style="float: left; clear: both; width: 600px; margin-left: 30%;">
    <div id="resultado" class=""><img id="imgSalida" width="600" /></div>
  </div>

  <div style="float: left; clear: both; margin-left: 45%;">
    <input name="submit" type="submit" class="myButton" value="Enviar publicación">   
  </div>
</form>  

<?php 
if (isset($_POST['submit'])) {  
 //print_r($conn->errorInfo()) ; die();
 
  require "../conexion.php";
 
  $imagen = $_FILES['file-input']['tmp_name']; //Obtiene la imagen  

  $imagen_tipo = exif_imagetype($_FILES['file-input']['tmp_name']);

  if ($imagen_tipo == IMAGETYPE_PNG OR $imagen_tipo == IMAGETYPE_JPEG OR $imagen_tipo == IMAGETYPE_BMP) {

  //$descripcion = $mysqli->real_escape_string($_POST['descripcion']);
    $descripcion = $conn->quote($_POST['descripcion']); //Quitar caracteres no deseados para agregar a la BD
    $titulo = $conn->quote($_POST['titulo']); //Quitar caracteres no deseados para agregar a la BD
    $categoria =$_POST['categoria']; //Quitar caracteres no deseados para agregar a la BD
    //Agrega el id_categoria
    $ID_C = $conn->prepare("SELECT id_categoria FROM categoria WHERE titulo = '$categoria'");
    $ID_C->execute(); 
    $CAT = $ID_C->fetch();
    $id_categoria = $CAT['id_categoria'];
    
    if(is_uploaded_file($_FILES['file-input']['tmp_name'])) { 

        $result = $conn->query("SHOW TABLE STATUS WHERE `Name` = 'archivos'"); //verificar cual es el siguiente ID de la tabla de archivos
        //$data = $result->fetch_assoc();
        $data = $result->fetch(PDO::FETCH_ASSOC);
        $next_id = $data['Auto_increment'];

        $ext = ".jpg"; 
        $namefinal = trim ($_FILES['file-input']['name']);
        $namefinal = str_replace (" ", "", $namefinal);
        $aleatorio = substr(strtoupper(md5(microtime(true))), 0,6);
        $namefinal = 'ID-'.$next_id.'-NAME-'.$aleatorio; 

        if ($imagen_tipo == IMAGETYPE_PNG) {

          $image = imagecreatefrompng($imagen);
          imagejpeg($image, 'archivos/'.$namefinal.$ext, 100);           

          $nuevaimagen = 'archivos/'.$namefinal.$ext;
        }

        else {
          $nuevaimagen = $imagen;
        }

        $original = imagecreatefromjpeg($nuevaimagen);
        $max_ancho = 1080; $max_alto = 1080;
        list($ancho,$alto)=getimagesize($nuevaimagen);

        $x_ratio = $max_ancho / $ancho;
        $y_ratio = $max_alto / $alto;

        if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
            $ancho_final = $ancho;
            $alto_final = $alto;
        }
        else if(($x_ratio * $alto) < $max_alto){
            $alto_final = ceil($x_ratio * $alto);
            $ancho_final = $max_ancho;
        }
        else {
            $ancho_final = ceil($y_ratio * $ancho);
            $alto_final = $max_alto;
        }

        $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 

        imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
         
        imagedestroy($original);

        imagejpeg($lienzo,"../archivos/".$namefinal.$ext);
          
      }

        if($_FILES['file-input']['tmp_name']) {
          $defau = 0;
          
          $id_us = $_SESSION['id_usuario'];
          $fecha = (new \DateTime())->format('Y-m-d H:i:s');

          //Agrega la publicacion
          $queryPub =  "INSERT INTO publicacion (titulo,categoria,foto,texto,id_usuario,id_categoria,bien,regular,mal,id_valoracion,fecha) VALUES (?,?,?,?,?,?,?,?,?,?,?)";//query para registrar publicacion
          $stmt= $conn->prepare($queryPub);
          $stmt->execute([$titulo,$categoria,$defau,$descripcion,$id_us,$id_categoria,$defau,$defau,$defau,2,$fecha]);

          $ultpub = $conn->prepare("SELECT id_publicacion FROM publicacion WHERE id_usuario = '".$_SESSION['id_usuario']."' ORDER BY id_publicacion DESC LIMIT 1");
          $ultpub->execute(); 
          $ultp = $ultpub->fetch();

          $ruta= $namefinal.$ext;
          $tipo= $_FILES['file-input']['type'];
          $size= $_FILES['file-input']['size'];
          $publicacion= $ultp['id_publicacion'];

          $query = "INSERT INTO archivos (user,ruta,tipo,size,publicacion,fecha) VALUES (?,?,?,?,?,?)";

          $arch= $conn->prepare($query);
          $arch->execute([$id_us ,$ruta,$tipo,$size,$publicacion,$fecha]);

       if($query) {header("refresh: 0; url = ../registrado.php");}
        }  
    }  

     else {echo "<script type='text/javascript'>alert('Imagen no compatible');</script>";}
     
 } 
?> 
  </body>  
</html>