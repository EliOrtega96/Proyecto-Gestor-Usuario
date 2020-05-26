<?php
session_start();

require "conexion.php";

$postid = $_POST['id'];
$postid = intval(preg_replace('/[^0-9]+/', '', $postid), 10); //Deja solo los numeros en este caso
$user = $_SESSION['id_usuario'];
$tipo = $_POST['tip'];
$fecha = (new \DateTime())->format('Y-m-d H:i:s');

$countLikes = $conn->prepare("SELECT * FROM reaccion WHERE id_usuario = '$user' AND id_publicacion = '$postid'");
$countLikes->execute();
$cLike = $countLikes->rowCount(); //comprueba si ya tiene una reaccion
$reaccion = $countLikes->fetch();
$tipo_reaccion = $reaccion['tipo'];//verifica que tipo de reaccion

if($cLike == 0) {
	$insertLike = "INSERT INTO reaccion (tipo,id_publicacion,id_usuario,fecha) VALUES ('$tipo','$postid','$user','$fecha')";
	$conn->exec($insertLike);

	$updatePub = "UPDATE publicacion SET mal = mal+1 WHERE id_publicacion = '$postid'";
	$conn->exec($updatePub); //ejecuta query
} else {
	$insertLike = "DELETE FROM reaccion WHERE id_usuario = '$user' AND id_publicacion = '$postid'";
	$conn->exec($insertLike); //ejecuta query
	switch ($tipo_reaccion) {
	    case 1://Tenia un Me_gusta
			$updatePub = "UPDATE publicacion SET bien = bien-1 WHERE id_publicacion = '$postid'";
	        $conn->exec($updatePub);
	        $insertLike = "INSERT INTO reaccion (tipo,id_publicacion,id_usuario,fecha) VALUES ('$tipo','$postid','$user','$fecha')";
	        $conn->exec($insertLike);
			$updatePub = "UPDATE publicacion SET mal = mal+1 WHERE id_publicacion = '$postid'";
	        $conn->exec($updatePub);
	        break;
	    case 2://Tenia un Me_encanta
	        $updatePub = "UPDATE publicacion SET regular = regular-1 WHERE id_publicacion = '$postid'";
	        $conn->exec($updatePub);
	        $insertLike = "INSERT INTO reaccion (tipo,id_publicacion,id_usuario,fecha) VALUES ('$tipo','$postid','$user','$fecha')";
	        $conn->exec($insertLike);
			$updatePub = "UPDATE publicacion SET mal = mal+1 WHERE id_publicacion = '$postid'";
	        $conn->exec($updatePub);
	        break;
	    case 3://Tenia un Me_entristece
	        $updatePub = "UPDATE publicacion SET mal = mal-1 WHERE id_publicacion = '$postid'";
			$conn->exec($updatePub);	
	        break;
	}
}

$tipoA = $conn->prepare("SELECT tipo FROM reaccion WHERE id_usuario = '$user' AND id_publicacion = '$postid'");
$tipoA->execute();
$t= $tipoA->fetch();
$tipo_r = $t[0];

if($cLike == 0 || $tipo_r == 3) {
	$bienR = "<img src='img/icons/me_enoja2.png' style ='height: 40px; width: 40px; padding-top: 10px; padding-right: 15px;'>";
}else {
	$bienR = "<img src='img/icons/me_enoja.png' style ='height: 40px; width: 40px; padding-top: 10px; padding-right: 15px;'>";
}

$return3 = array("img"=>$bienR);

echo json_encode($return3);
?>
