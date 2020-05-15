<?php
    session_start();
    //CAMBIOS GERARDO
    require("conexion.php");
     //CAMBIOS ISABEL
    if(!isset($_SESSION['logueado']) && $_SESSION['logueado'] == FALSE) {
          header("Location: login.php");
    }
    //TERMINA CAMBIOS ISABEL
    $obtienemsj = $conn->prepare("SELECT mensajes.fechayhora, mensajes.id_emisor, mensajes.mensaje, usuario.nombre FROM mensajes inner join usuario WHERE id_receptor=$_SESSION[id_usuario] && mensajes.id_emisor=usuario.id_usuario ORDER BY fechayhora DESC") ; //query para obtener usuario con correo y contraseña ingresados en formulario login.php
    $sqlcount=$conn->prepare("SELECT count(*) FROM mensajes");
    $obtienemsj->execute();
    $sqlcount->execute();
    $cantmsj=$sqlcount->fetch(PDO::FETCH_NUM);
    $nummensajes=$cantmsj[0];
    //TERMINA CAMBIOS
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="icomoon/style.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
         <!-- CAMBIOS ISABEL-->
        <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
        <!-- TERMINA CAMBIOS -->
    </head>
    <body>
        <!--CAMBIOS GERARDO-->
        <div class="ventana" id="vent">
            <div id="cerrar"><a href="javascript:cerrar()"><img src="img/cerrar.png"></a></div>
            Notificaciones <br>
            <?php while ($row=$obtienemsj->fetch(PDO::FETCH_ASSOC)){
                echo "<div class=\"mensaje\">";
                    echo "<div class=\"fechayhora\">".$row["fechayhora"]."</div>";
                    echo "<div class=\"emisor\">".$row["nombre"]."</div>";
                    echo "<div class=\"contenido\">".$row["mensaje"]."</div>";
                echo "</div>";
            }?>
        </div>
<!--TERMINA CAMBIOS-->
        <header>
            <h1 class="titulo" >Gestor de Usuario</h1>     
            <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li class="info_usuario"><a href="#"><?php echo $_SESSION['nombre'];?></a>
                <ul id="nav-perfil">
                    <li> <a href="cerrarsesion.php">Cerrar Sesion</a></li>
                </ul>
                <!--CAMBIOS GERARDO-->
                <li><a href="javascript:abrir()"><span class="icon-mail2"></span> <span class="no-leido"><?php if($nummensajes>0){echo $nummensajes;} ?></span></a></li>
                <!--TERMINA CAMBIOS-->
            </li> 
            <li><a href="solicitar.php"><?php  $_SESSION['id_usuario'];?><span class="icon-user-tie"></span> <span class="">solicitar rol Moderador</span></a></li>
        </ul>
    </nav>
    <div>
    </div>
    </header>
    <!--CAMBIOS GERARDO--> 
  <script> function abrir(){document.getElementById("vent").style.display="block";}
        function cerrar(){document.getElementById("vent").style.display="none";}</script>
        <!--TERMINA CAMBIOS -->

</body>
</html>