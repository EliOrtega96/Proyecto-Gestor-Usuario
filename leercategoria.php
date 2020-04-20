<?php
    require_once('conexion.php'); //incluye en archivo conexion DB

    $query = $conn->prepare("SELECT * FROM categoria ");   //lee todos los usuarios de la tabla categpria
    $query->execute(); //ejecuta el query
?>