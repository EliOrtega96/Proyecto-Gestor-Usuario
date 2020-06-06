

<?php
    session_start();

    require_once('conexion.php');
    $id = $_GET['id'];
    $id_emisor= $_SESSION['id_usuario'];
    $queryuser = $conn->prepare("SELECT id_usuario FROM publicacion WHERE id_publicacion=$id") ; 
    $queryuser->execute();
    $row=$queryuser->fetch(PDO::FETCH_NUM);
    $id_user=$row[0];

    $queryUser = "UPDATE publicacion SET id_valoracion = 0 WHERE publicacion.id_publicacion = $id;"; //query para actualizar datos
        $conn->exec($queryUser); //ejecuta query

        $queryMsj="INSERT INTO mensajes (id_emisor, id_receptor, mensaje) VALUES ($id_emisor,$id_user,' PUBLICACION RECHAZADA');";
        $conn->exec($queryMsj);
        header('Location: moderador.php'); //una vez actualizados los datos redirecciona a 
    
?>
