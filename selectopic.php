<?php
    require("conexion.php");
    $obtienecategoria=$conn->prepare("SELECT titulo FROM categoria");
    $sqlcount=$conn->prepare("SELECT count(*) FROM categoria");
    $obtienecategoria->execute();
    $sqlcount->execute();
    $cantcateg=$sqlcount->fetch(PDO::FETCH_NUM);
    $numcateg=$cantcateg[0];
        if(!empty($_POST)){  //valida que el formulario tenga datos
        /*$nombre = $_POST['nombre']; // obtiene dato ingresado en el campo   
        $correo = $_POST['correo'];  // obtiene dato ingresado en el campo correo del formulario  
        $pass = $_POST['password']; // obtiene dato ingresado en el contraseña usuario del formulario  
        $rol = $_POST['id_rol'];
        $queryUser = "INSERT INTO usuario (nombre,correo,password,id_rol,activo,dias) VALUES('$nombre','$correo', '$pass','$rol','1','0')";  //query para registrar 
        $conn->exec($queryUser); //ejecuta query*/
        header('Location: login.php');  // despues de registrar redirecciona a login.php
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>
    <body>
    <div class="contenedor-form">
        <h1>Seleccionar temas</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">    
            <?php $cont=1; while ($row=$obtienecategoria->fetch(PDO::FETCH_ASSOC)){    
                    echo "<h2><input type=\"checkbox\" name=\"cbox$cont\" value=".$row["titulo"].">".$row["titulo"]."</h2>";$cont=$cont+1;
            }?>
            <input type="submit" value="Guardar"  name="registrar" class="log-btn">
        </form>
        </div>
       
    </body>
</html>