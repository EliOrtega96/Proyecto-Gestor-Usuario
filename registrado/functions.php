<!-- CREO ISABEL -->
<?php

function datos_usuario($id,$value) {

	require "./conexion.php";

	$datosZ = $conn->query("SELECT * FROM usuario WHERE id_usuario = $id");
	$rowZ = $datosZ->fetch();

	echo $rowZ['nombre'];
}

?>