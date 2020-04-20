<?php
    require_once('conexion.php');
    session_start();
    $id_categoria = $_GET['categoria'];  //obtiene el id del elemento que se va a eliminar
  

   
   $user = "DELETE FROM categoria WHERE id_categoria='$id_categoria' ";   //query para eliminar el usuario que se va eliminar
    $conn->exec($user); //ejecuta el query

    header("Location: moderador.php");  //una vez eliminado redirecciona a index.
?>