<?php
    require_once('conexion.php');
    session_start();
  
    $id = $_SESSION['id_usuario'];
    
        $queryUser = "UPDATE usuario SET id_rol = 4 WHERE usuario.id_usuario = $id;"; //query para actualizar datos
        $conn->exec($queryUser); //ejecuta query
        header('Location: index.php'); //una vez actualizados los datos redirecciona a index.php
        echo "Usuario Aceptado ";
    
?>
    