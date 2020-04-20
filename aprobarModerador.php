<?php
    require_once('conexion.php'); //incluye en archivo conexion DB

    $query = $conn->prepare("SELECT * FROM usuario WHERE id_rol = 4 ");   //lee todos los usuarios de la tabla categpria
    $query->execute(); //ejecuta el query
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8 /> 
        <link rel="stylesheet" type="text/css" href="#">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    
        <title> Registro </title>
    </head>
    <body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item ">
      <a class="nav-link" href="admin.php">Estadistica de usuarios</a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="aprobarModerador.php">Aprobar Moderador</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="cerrarsesion.php">Salir</a>
    </li>
    
  </ul>
</nav>
<h1>Administrador</h1>

<div class="container">
    <h2 style="text-align:center">Usuarios Solicitados</h2>
<div class="container">
   <div class="row">
        <table style="width: 100%;"> <!-- tabla de usuarios registrados -->
            <thead>
                <tr>
                    
                    <td>id</td>
                    <td>Nombre</td>
                    <td>Correo</td>
                   
                   
                </tr>
                <?php 
                while($res = $query->fetch()) { 		
                    echo "<tr>";
                    echo "<td>".$res['id_usuario']."</td>"; //nombre de los campos de la base de datos.
                    echo "<td>".$res['nombre']."</td>";
                    echo "<td>".$res['correo']."</td>";
                    
                    echo "<td><a href='aceptar.php?id=$res[id_usuario]'><button type='button' class='btn btn-success'>Aceptar</button></td>"; //boton editar, al dar clic manda al archivo editar.php mandando el id del registro que se va editar	                             
                    
                    echo "<td><a href='rechazar.php?id_usuar=$res[id_usuario]'> <button type='button' class='btn btn-danger'>Rechazar</button></a></td>";		
                    echo "</tr>";  
                
                     
                    
                }
            ?>
            </thead>
        <?php 
        echo "<tr>";   
              
      	
             
            
          
            
            
             
          	
         
            
            ?>
            </table>
        </div>
    </div>
    </body>
</html>