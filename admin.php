

<?php
    require_once('conexion.php'); //incluye en archivo conexion DB

    $query = $conn->prepare("SELECT * FROM usuario inner join rol on usuario.id_rol = rol.id_rol ");   //lee todos los usuarios de la tabla usuario
    $query->execute(); //ejecuta el query

    if(!empty($_POST)){  //valida que el formulario tenga datos
      $nombre = $_POST['nombre']; // obtiene dato ingresado en el campo usuario del formulario  
      $correo = $_POST['correo'];  // obtiene dato ingresado en el campo correo del formulario  
      $pass = $_POST['password']; // obtiene dato ingresado en el contraseña usuario del formulario  
      $rol = $_POST['id_rol'];
      $queryUser = "INSERT INTO usuario (nombre,correo,password,id_rol) VALUES('$nombre','$correo', '$pass','$rol')";  //query para registrar 
      $conn->exec($queryUser); //ejecuta query
      
      header('Location: admin.php');  // despues de registrar redirecciona a login.php
  }
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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        
        <title> Registro </title>
    </head>
    <body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="admin.php">Usuarios</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reportes.php">Reportes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="aprobarModerador.php">Aprobar Moderador</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="temas.php">Temas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cerrarsesion.php">Salir</a>
      </li>
  </ul>
</nav>
<h1>Administrador</h1>
<div class="container">
<div class="row"><h2 style="text-align:left">Usuarios Registrados</h2> <button style="margin-left:250px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Registra Usuario</button></div>
<div class="container"> 
   <div class="row">
        <table style="width: 100%;"> <!-- tabla de usuarios registrados -->
            <thead>
                <tr>
                    
                    <td>id</td>
                    <td>Nombre</td>
                    <td>Correo</td>
                    <td>Rol</td>
                   
                   
                </tr>
                <?php 
                while($res = $query->fetch()) { 		
                    echo "<tr>";
                    echo "<td>".$res['id_usuario']."</td>"; //nombre de los campos de la base de datos.
                    echo "<td>".$res['nombre']."</td>";
                    echo "<td>".$res['correo']."</td>";
                    echo "<td>".$res['rol']."</td>";
                    
                    	                             
                    
                    echo "<td><a href='eliminarUsuario.php?id_usuar=$res[id_usuario]'> <button type='button' class='btn btn-danger'>Eliminar</button></a></td>";		
                    echo "</tr>";  
                
                     
                    
                }
            ?>
            </thead>
          </table>
      </div> 
              </div>
              
              
  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Crear Usuario</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Usuario</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nombre"  placeholder="Usuario">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Correo</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="correo" placeholder="Email">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="password" placeholder="Password">
    </div>
  </div>
  <div class="form-group row">
  <label class="col-md-2" for="inlineFormCustomSelectPref">Rol </label>
  <select class="col-md-10 custom-select" name="id_rol">
    <option selected>Seleccione uno</option>
    <option value="2">Administrador</option>
    <option value="1">Usuario</option>
    <option value="3">Moderador</option>
  </select>
  </div>
  
  <div class="form-group row">
    <div class="col-sm-12">
      <button type="submit" class="btn btn-primary col-sm-12">Crear</button>
    </div>
  </div>
</form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
              </body>
              </html>


