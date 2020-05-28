<!DOCTYPE html>
<html lang="es">  
  <head>  
	<meta charset="UTF-8">

    <meta name="title" content="Usuario">
    <meta name="description" content="Photogram"> 
    <link rel="stylesheet" href="css/style.css">   
    <!-- <link href="css/style.css" rel="stylesheet" type="text/css"/>  -->
    <link href="css/instagram.css" rel="stylesheet" type="text/css"/>   
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  </head>  
  <body>   
        <header>
            <h1 class="titulo" >RED SOCIAL</h1>     
            <nav>
            <ul>
                <li><a style="color:black; background: white; "href="login.php">Login</a></li>
            </ul>
    		</nav>
    </header>

    <div class="h-header">
		<div class="h-logo"><a href="#"><img src="img/logo2.png" width="130"></a></div>
		<div class="h-account">
			<a href="#"><img src="img/icons/explorar.png" class="i-icon"></a>
			<a href="#"><img src="img/logo2.png" width="130"></a>
		</div>
	</div>

	<div class="h-content">
		<div class="h-left">
			<?php 
			require "conexion.php";
			//print_r($conn->errorInfo()) ; die();
			$sqlA = $conn->prepare("SELECT * FROM publicacion where id_valoracion=1 ORDER BY id_publicacion DESC");
			$sqlA->execute();
			
			//$data=$query->fetch(PDO::FETCH_ASSOC)
			while($rowA = $sqlA->fetch()) {//selecciona publicacion a publicacion de forma descendente
				$sqlB = $conn->prepare("SELECT * FROM usuario WHERE id_usuario = '".$rowA['id_usuario']."'");//verifica qu ecoincida el ide de usuario que publico con algun usuario en la tabla usuarios
				$sqlB->execute();
				$rowB = $sqlB->fetch();
				$sqlC = $conn->prepare("SELECT * FROM archivos WHERE publicacion = '".$rowA['id_publicacion']."'");
				$sqlC->execute();
				$rowC = $sqlC->fetch();	

			?>
			<div class="hl-cont2">
				<div class="hl-profile"></div>
				<div class="hl-profile hl-username ">
					<div class="hl-location2"><a style="color: rgb(119,136,153);"><?php echo "Categoria: ".$rowA['categoria']; ?></a></div> <!-- Muestro la categoria de la publicacion-->
						<div class="hl-titulo2"><a style="color: rgb(176,196,222);"><?php echo "Titulo: ".$rowA['titulo']; ?></a></div> <!-- Muestro el ttulo de la publicacion-->
				</div>	
				<div class="hl-middle">
					<img src="archivos/<?php echo $rowC['ruta']; ?>" style = "height: 100%; width: 100%"	>
				</div>		
				<!--Descripcion de la publicacion-->	
				<div class="hl-bottom">
					<strong style="color: #262626;"><?php echo $rowB['nombre']; ?></strong> <?php echo $rowA['texto']; ?>
				</div>			
			<?php } error_reporting(E_ALL); ?>
			</div>
		</div>
  	</body>  
</html>