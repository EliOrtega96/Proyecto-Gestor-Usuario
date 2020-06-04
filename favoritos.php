<?php
require_once("conexion.php");
session_start();
$user =  $_SESSION['id_usuario'];
$dat = $conn->prepare("SELECT count(*) as datos FROM favorito where id_usuario = '$user'"); //query para obtener usuario con correo y contraseña ingresados en formulario login.php
        $dat->execute();
        $valDatos = $dat->fetch();
    
       // $fav =$_POST['cbox'];

      //  if( $valDatos['datos']>0 &&  !isset($_POST['cbox']) ){
           // header('Location: registrado.php');
          
       // }
        if( $valDatos['datos']<=0 &&  !isset($_POST['cbox']) ){
            header('Location: selectopic.php');
        }

if(!empty($_POST) && isset($_POST['cbox'])){ 
    $fav =$_POST['cbox'];
foreach ($fav as $dato => $valor){
    
     //valida que el formulario tenga datos
       
            
        $sql = $conn->prepare("SELECT * FROM favorito WHERE id_usuario ='$user' AND id_Categoria ='$valor'"); //query para obtener usuario con correo y contraseña ingresados en formulario login.php
        $sql->execute();
        $result = $sql->fetch();
      
        if( $result>0 ){
            header('Location: registrado.php');
        }else {
            
            echo "registro exitoso";
            $queryUser = "INSERT INTO favorito (id_usuario,id_categoria) VALUES('$user','$valor')";  //query para registrar 
            $conn->exec($queryUser);
            header('Location: registrado.php');
            }
    //$
    }
}else {
    header('Location: registrado.php'); 
  
}

?>