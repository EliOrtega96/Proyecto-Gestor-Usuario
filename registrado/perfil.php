<!-- CREO ISABEL -->
<?php
session_start();
if(!isset($_SESSION['logueado']) && $_SESSION['logueado'] == FALSE) {
  header("Location: index.php");
}

include "functions.php";
?>

<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>RED SOCIAL</title>    
    <meta charset="UTF-8">
    <meta name="title" content="Photogram">
    <meta name="description" content="Photogram">    
    <link href="css/style.css" rel="stylesheet" type="text/css"/>  
    <link href="css/instagram.css" rel="stylesheet" type="text/css"/>   
  </head>  
  <body>   

  	<?php

  	if(isset($_GET['nombre'])) {
  		require "../conexion.php";
  		//Obtiene datos del usuario		
  		$sqlA = $conn->prepare("SELECT * FROM usuario WHERE nombre = '".$_GET['nombre']."'");
  		$sqlA->execute();
  		$rowA = $sqlA->fetch();
  		//echo "tamano".sizeof(rowA);
  		//Calcula el numero de pubicaciones
  		$sqlB = $conn->prepare("SELECT * FROM publicacion WHERE id_usuario = '".$rowA['id_usuario']."' ORDER BY id_publicacion DESC");
  		$sqlB->execute();
  		$totalp = $sqlB->rowCount();

  	?>

<div class="h-content">
	
	<div class="p-top">
		<div class="p-name">
			<div class="h-header">
				<div class="h-logo"><a href="../registrado.php"><img src="../img/logo2.png" width="130"></a>
				<a href="../registrado.php"><img src="../img/icons/explorar.png" class="i-icon"></a>
			</div>
			
			<div class="p-user"><?php echo $rowA['nombre'];?></div>
			<?php if($rowA['id_usuario'] == $_SESSION['id_usuario']) { ?>
			<!--Editar perfil -->
			<div class="p-editar"><a href="editar_perfil.php"><button class="button_white">Editar perfil</button></a></div>
			<?php } else { ?>

			<?php if($tAprobo == 0) { ?>

				<?php if($yaEnviaste > 0) { ?>
					<div class="p-editar"><button class="button_blue">Solicitud enviada</button></div>
				<?php } else { ?>
					<a href="?seguir=seguir&username=<?php echo $_GET['nombre']; ?>"><div class="p-editar"><button class="button_blue">Seguir</button></div></a>
				<?php } ?>

			<?php } ?>

			<?php } ?>
		</div>
		<div class="p-info">
			<div class="p-infor"><b><?php echo $totalp; ?></b> publicaciones</div>
		</div>
		<div class="p-nombre"><?php echo $rowA['nombre'];?></div>
		<div class="p-location">Mexico</div>
		<!-- <div class="p-description"><?php //echo $rowA['bio'];?></div>-->
	</div>

	<div class="p-mid">

		<?php
		while($rowC = $sqlB->fetch()) {
			$sqlD = $conn->prepare("SELECT * FROM archivos WHERE publicacion = '".$rowC['id_publicacion']."'");
			$sqlD->execute(); 
			$rowD = $sqlD->fetch();
		?>
			<div class="p-pub" style="background-image: url('../archivos/<?php echo $rowD['ruta']; ?>');"></div>
		<?php } ?>


	</div>

</div>

<?php } ?>

  </body>  
</html>