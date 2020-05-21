<?php
    require_once('conexion.php');
    if(!empty($_POST)){  //valida que el formulario tenga datos
        $titulo = $_POST['titulo']; // obtiene dato ingresado en el campo usuario del formulario  
        
        $queryUser = "INSERT INTO categoria (titulo) VALUES('$titulo')";  //query para registrar 
        $conn->exec($queryUser); //ejecuta query
        
        header('Location: temas.php');  // despues de registrar redirecciona a login.php
    }

   
?>