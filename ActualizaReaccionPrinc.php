<?php
	include ('conexion.php');
	$id = $_POST['postId'];
	session_start();

	$sqlA = $conn->prepare("SELECT * FROM publicacion WHERE id_publicacion = $id");
	$sqlA->execute();

	if(!isset($sqlA)){  
 		die('Query Failed');
    }

	$rowA = $sqlA->fetch();	

	$sqlB = $conn->prepare("SELECT * FROM usuario WHERE id_usuario = '".$rowA['id_usuario']."'");//verifica qu ecoincida el id de usuario que publico con algun usuario en la tabla usuarios
	$sqlB->execute();
	$rowB = $sqlB->fetch();

	$sqlC = $conn->prepare("SELECT * FROM archivos WHERE publicacion = '".$rowA['id_publicacion']."'");
	$sqlC->execute();
	$rowC = $sqlC->fetch();	

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