<?php
    require_once('conexion.php'); //incluye en archivo conexion DB
    $query = $conn->prepare("select p.id_publicacion, p.titulo,p.categoria,p.texto, u.nombre, c.ruta
    from publicacion p inner join usuario u on p.id_usuario = u.id_usuario
    inner join archivos c on p.id_publicacion = c.publicacion where p.id_valoracion = 2");   //lee todos los usuarios de la tabla categpria
    $query->execute(); //ejecuta el query
    
?>
<!DOCTYPE html>
<html lang="es">
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="#">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <title> Publicaciones </title>
        <style>
            img{
                width: 250px;
                height: 150px;
                margin-top:20px;
            }
        </style>
    </head>
    <body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="moderador.php">Publicaciones</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cerrarsesion.php">Salir</a>
      </li>
      
  </ul>
</nav>
<h1>Moderador</h1>

    <h2 style="text-align:center">Publicaciones</h2>
    <div class="container">
        <div class="row">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">img</th>
                        <th scope="col">contenido</th>
                        <th scope="col">Creador</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Aprobar</th>
                        <th scope="col">Rechazar</th>
                    </tr>
                </thead>
            <body>
                
                <?php 
                        while($res = $query->fetch()) 
                        {  
                            $img = $res['ruta'];
                            echo "<tr>";
                            echo "<td>".$res['id_publicacion']."</td>";   
                            echo "<td>".$res['titulo']."</td>";
                            echo "<td>"."<img src='archivos/$img' >"."</td>";
                            echo "<td>".$res['texto']."</td>";
                            echo "<td>".$res['nombre']."</td>";
                            echo "<td>".$res['categoria']."</td>";
                            echo "<td><a href='aceptarPublicacion.php?id=$res[id_publicacion]'><button type='button' class='btn btn-success'>Aceptar</button></a></td>"; //boton editar, al dar clic manda al archivo editar.php mandando el id del registro que se va editar	                             
                            echo "<td><a href='rechazarPublicacion.php?id=$res[id_publicacion]'><button type='button' class='btn btn-danger' >Rechazar</button></td>";		
                            echo "<hr></tr>";
                        }
                ?>      
            </body>      
           </table>
        </div>
    </div>
    </body>
</html>