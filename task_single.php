<?php
	include ('conexion.php');
	
	if (isset($_POST['id'])) {
		$id = $_POST['id'];

		$query = $conn->prepare("SELECT * FROM publicacion WHERE id_publicacion = $id"); /*1) Consulta de un unico elemento en la tabla*/
		$query->execute();
		
		if(!isset($query)){  
 			die('Query Failed');
    	}
		/*Entonces regresar un json*/
		$json = array(); /*2) Recorrremos el resultado pata convertirlo en un JSON (un objeto)*/
		/*Convertir el dato de la tabla a un json para enviar al frontend para que pueda obtener los datos de la tarea*/
		$row = $query->fetch();
		$json[] = array(
			'name' => $row['id_usuario'],
			'id' => $row['id_publicacion']
		);
		
		/*3) Converto el json a string y envio al navegador*/
		$jsonstring = json_encode($json[0]); /*Envia el elemento 0 de ese arreglo*/
		echo $jsonstring;
	}
?>