<?php //No llamo a la base de datos porque ya cree una session

	include "index.php";
	//session_start();
	if(!isset($_SESSION['logueado']) && $_SESSION['logueado'] == FALSE) {
		  header("Location: login.php");
	}
	include "registrado/functions.php";
	
?> 

<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>RED SOCIAL</title>    
    <meta charset="UTF-8">
    <meta name="title" content="Usuario">
    <meta name="description" content="Photogram">    
    <!-- <link href="css/style.css" rel="stylesheet" type="text/css"/>  -->
    <link href="css/instagram.css" rel="stylesheet" type="text/css"/>   
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="js/bien.js"></script>
    <script src="js/regular.js"></script>
    <script src="js/mala.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  </head>  
  <body>   

<?php include "registrado/header.php" ?>

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
			<div class="hl-cont">
				<div class="hl-top">
					<div class="hl-profile">
						<div class="hl-pic"><a href="perfil.php?username=<?php echo $rowB['nombre'];?>"></a></div>
					</div>
					<div class="hl-username">
						<div class="hl-name"><a style="color: rgb(100,149,237);" href="registrado/perfil.php?nombre=<?php echo $_SESSION['nombre'];?>"><?php echo $rowB['nombre']; ?></a></div> <!-- Muestro nombre del autor de la publicacion, mismo que es un link para el perfil del usuario-->
						<div class="hl-location"><a style="color: rgb(119,136,153);"><?php echo "Categoria: ".$rowA['categoria']; ?></a></div> <!-- Muestro la categoria de la publicacion-->
						<div class="hl-titulo1"><a style="color: rgb(176,196,222);"><?php echo "Titulo: ".$rowA['titulo']; ?></a></div> <!-- Muestro el ttulo de la publicacion-->
					</div>	
				<div class="hl-middle">
					<img src="archivos/<?php echo $rowC['ruta']; ?>" style = "height: 100%; width: 100%">
				</div>	
				<div id = "reaccionesPP" class="hl-section-likes">
					<!--BIEN -->
					<?php 
					
						$countLikes = $conn->prepare("SELECT * FROM reaccion WHERE id_usuario = '".$_SESSION['id_usuario']."' AND id_publicacion = '".$rowA['id_publicacion']."'");
						$countLikes->execute();
						$cLikes = $countLikes->rowCount();
						$reaccion = $countLikes->fetch();
						$tipo_r = $reaccion['tipo'];
						
						if($cLikes == 0 || $tipo_r != 1) { //si es igual a 0 , no le ha dado like  ?>
							<div id="Bien<?php echo $rowA['id_publicacion']; ?>" class="bien" style="float: left; cursor: pointer;"><img src="img/icons/cora.png"></div>
					<?php } 		
						
						$countLikes = $conn->prepare("SELECT * FROM reaccion WHERE id_usuario = '".$_SESSION['id_usuario']."' AND id_publicacion = '".$rowA['id_publicacion']."'");
						$countLikes->execute();
						$cLikes = $countLikes->rowCount(); //comprueba si ya tiene una reaccion
						$reaccion = $countLikes->fetch();
						$tipo_r = $reaccion['tipo'];
						
						if ($cLikes == 1 &&  $tipo_r == 1) {?>
							<div id="Bien<?php echo $rowA['id_publicacion']; ?>" class="bien" style="float: left; cursor: pointer;"><img src="img/icons/cora2.png"></div>
					<?php } ?>

					<!-- REGULAR -->
					<?php 
						
						$countLikes = $conn->prepare("SELECT * FROM reaccion WHERE id_usuario = '".$_SESSION['id_usuario']."' AND id_publicacion = '".$rowA['id_publicacion']."'");
						$countLikes->execute();
						$cLikes = $countLikes->rowCount(); 
						$reaccion = $countLikes->fetch();
						$tipo_r = $reaccion['tipo'];
						
						if($cLikes == 0 || $tipo_r != 2) {?>
							<div id="Regular<?php echo $rowA['id_publicacion']; ?>" class="regular" style="float: left; cursor: pointer;"><img src="img/icons/me_gusta.png"></div>
					<?php } 		
							
						$countLikes = $conn->prepare("SELECT * FROM reaccion WHERE id_usuario = '".$_SESSION['id_usuario']."' AND id_publicacion = '".$rowA['id_publicacion']."'");
						$countLikes->execute();
						$cLikes = $countLikes->rowCount();
						$reaccion = $countLikes->fetch();
						$tipo_r = $reaccion['tipo'];
				
						if ($cLikes == 1 &&  $tipo_r == 2) {?>
							<div id="Regular<?php echo $rowA['id_publicacion']; ?>" class="regular" style="float: left; cursor: pointer;"><img src="img/icons/me_gusta2.png"></div>
					<?php } ?>
					

					<!--MAL -->
					<?php
						$countLikes = $conn->prepare("SELECT * FROM reaccion WHERE id_usuario = '".$_SESSION['id_usuario']."' AND id_publicacion = '".$rowA['id_publicacion']."'");
						$countLikes->execute();
						$cLikes = $countLikes->rowCount(); 
						$reaccion = $countLikes->fetch();
						$tipo_r = $reaccion['tipo'];

						if($cLikes == 0 || $tipo_r != 3) { ?>
							<div id="Mal<?php echo $rowA['id_publicacion']; ?>" class="mal" style="float: left; cursor: pointer;"><img src="img/icons/me_enoja.png"></div>
					<?php } elseif ($cLikes == 1 && $tipo_r == 3) { ?>
						<div id="Mal<?php echo $rowA['id_publicacion']; ?>" class="mal" style="float: left; cursor: pointer;"><img src="img/icons/me_enoja2.png"></div>
					<?php } ?>

				</div>
				<!--Muestra el conteo de reacciones -->
				<div class="hl-bottom" id="conteo">
					<?php
						$CReac = $conn->prepare("SELECT bien,regular,mal FROM publicacion WHERE id_publicacion = '".$rowA['id_publicacion']."'");
						$CReac->execute();
						$AReac = $CReac->fetch();
						$NBien = $AReac['bien'];
						$NRegular = $AReac['regular'];
						$NMal = $AReac['mal'];?>


						<strong style="color: rgb(0,0,255);"><?php echo "Bien:".$NBien; ?></strong>
						<strong style="color: rgb(255,0,0);"><?php echo "  Regular:".$NRegular; ?></strong>
						<strong style="color: rgb(128,0,0);"><?php echo " Mal:".$NMal; ?></strong>
				</div>	
				<!--Descripcion de la publicacion-->	
				<div class="hl-bottom">
					<strong style="color: #262626;"><?php echo $rowB['nombre']; ?></strong> <?php echo $rowA['texto']; ?>
				</div>			
			</div>

		<?php } error_reporting(E_ALL); ?>

	</div>

</div>

  </body>  
</html>