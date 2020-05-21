<?php
    require_once('conexion.php');
    $id = $_GET['id'];
    
        $queryUser = "UPDATE publicacion SET id_valoracion = 1 WHERE publicacion.id_publicacion = $id;"; //query para actualizar datos
        $conn->exec($queryUser); //ejecuta query
        header('Location: moderador.php'); //una vez actualizados los datos redirecciona a 
        
    
?>