
<?php
session_start();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="icomoon/style.css">

</head>
<body>
   <header>
      <h1 class="titulo" >Gestor de Usuario</h1>
     
      <nav>
         <ul>
             <li><a href="index.php">Inicio</a></li>
             <li>
                 <a href="#"><span class="icon-mail2"></span> <span class="no-leido">12</span></a>
             </li>
             <li class="info_usuario"><a href="#"><?php echo $_SESSION['nombre'];?></a>
             <ul id="nav-perfil">
                <li> <a href="cerrar.php">Cerrar Sesion</a></li>
             </ul>
            </li>  
        </ul>
        </nav>
    
   
    </header> 
    
    
  
    
</body>
</html>