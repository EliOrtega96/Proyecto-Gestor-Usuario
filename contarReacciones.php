<?php
	include ('conexion.php');
	$id = $_POST['postId'];

	$CReac = $conn->prepare("SELECT bien,regular,mal FROM publicacion WHERE id_publicacion = $id");
	$CReac->execute();
		
	if(!isset($CReac)){  
 		die('Query Failed');
    }?>
   
	<?php
		$CReac->execute();
		$AReac = $CReac->fetch();
		$NBien = $AReac['bien'];
		$NRegular = $AReac['regular'];
		$NMal = $AReac['mal'];
	?>
	<strong style="color: rgb(0,0,255);"><?php echo "Bien:".$NBien; ?></strong>
	<strong style="color: rgb(255,0,0);"><?php echo "  Regular:".$NRegular; ?></strong>
	<strong style="color: rgb(128,0,0);"><?php echo " Mal:".$NMal; ?></strong>

