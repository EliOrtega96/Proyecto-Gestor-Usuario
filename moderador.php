<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8 /> 
        <link rel="stylesheet" type="text/css" href="#">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
        
        <title> Registro </title>
    </head>




<body>
    
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item ">
      <a class="nav-link" href="moderador.php">Crear Categoria.</a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="aprobarPublicacion.php">Aprobar Publicacion</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="cerrarsesion.php">Salir</a>
    </li>
    
  </ul>
</nav>
<h1>Moderador</h1>
<div class="container">
  <h2 style="text-align:center">Registrar Categoria</h2>
  <div class="row">     
    <form method="post" action="registrarCategoria.php"> 
      <div class="form-group">
        <label for="exampleInput">Titulo</label>
        <input type="text" required class="form-control" id="exampleInput" name="titulo" aria-describedby="emailHelp" placeholder="Nombre de Categoria">
      </div>
     
      <button type="submit" class="btn btn-primary">Crear</button>
    </form>
  </div>     
</div>

<div class="container">
    <h2 style="text-align:center">Temas registrados</h2>
<div class="container">
   <div class="row">
        <table style="width: 100%;"> <!-- tabla de usuarios registrados -->
            <thead>
                <tr>
                    
                    <td>Titulo</td>
                    
                </tr>
                <?php 
                require_once('conexion.php'); //incluye en archivo conexion DB

                $query = $conn->prepare("SELECT * FROM categoria ");   //lee todos los usuarios de la tabla categpria
                $query->execute(); //ejecuta el query
                while($res = $query->fetch()) { 		
                    echo "<tr>";
                    echo "<td>".$res['titulo']."</td>"; //nombre de los campos de la base de datos.
                    echo "<td><a href='eliminarCategoria.php?categoria=$res[id_categoria]'> <button type='button' class='btn btn-danger'>Eliminar</button></a></td>";		
                    echo "</tr>"; 
                   
                    
                    
                    
                
                     
                    
                }
            ?>
            </thead>
       
            </table>
        </div>
    </div>
    </body>
</html>