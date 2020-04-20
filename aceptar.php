<?php
    require_once('conexion.php');
    $id = $_GET['id'];
    
        $queryUser = "UPDATE usuario SET id_rol = 3 WHERE usuario.id_usuario = $id;"; //query para actualizar datos
        $conn->exec($queryUser); //ejecuta query
        header('Location: aprobarModerador.php'); //una vez actualizados los datos redirecciona a index.php
        echo "Usuario Aceptado ";
    
?>
    

   
