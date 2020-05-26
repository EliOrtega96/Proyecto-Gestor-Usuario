<?php
 require_once('conexion.php');
 
 if(!empty($_POST)){  
    	$usr = $_POST['usuario'];
    	
     	$query = $conn->prepare("SELECT p.id_publicacion,p.titulo,a.ruta,p.texto,c.titulo as categoria,u.nombre from publicacion p inner join categoria c on p.id_categoria=c.id_categoria inner join usuario u on u.id_usuario =p.id_usuario inner join archivos a on a.publicacion=p.id_publicacion where u.nombre='$usr' and p.id_valoracion=1"); 
     	$query->execute();
    	$q2 = $conn->prepare("SELECT count(*) as total FROM publicacion  inner join usuario on publicacion.id_usuario = usuario.id_usuario where  usuario.nombre = '$usr' and publicacion.id_valoracion=1");
      	$q2->execute();     
    }else {
    	echo "no recibi nada";
 	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  	<link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
  	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="js/app.js"></script>
	
  	<style>
	  	img{
	   	 	width: 500px;
	    	height: 400px;
	    }
  	</style>
</head>
<body>
  <div class="container">
    <div>
      <h1>Buscar</h1>
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link " id="categoria-tab" data-toggle="tab" href="#categoria" role="tab" aria-controls="categoria" aria-selected="true">Categoria</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="usuario-tab" data-toggle="tab" href="#usuario" role="tab" aria-controls="usuario" aria-selected="false">texto</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Usuario</a>
        </li>
        <li class="nav-item">
          <a  class="nav-link "  href="registrado.php"   aria-selected="false">Inicio</a>
        </li>
      </ul>

      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade" id="categoria" role="tabpanel" aria-labelledby="categoria-tab">
          categoria
          <form action="search_cat.php" method="post">
            <input type="text" name="categoria" id="">
            <input type="submit" value="Buscar">
          </form>
        </div>
        <div class="tab-pane fade" id="usuario" role="tabpanel" aria-labelledby="usuario-tab">
          texto
          <form action="search_text.php" method="post">
            <input type="text" name="texto" id="">
            <input type="submit" value="Buscar">
          </form>
        </div>
        <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab"> 
          usuario
			<form action="#" method="post">
            <input type="text" name="usuario" id="">
            <input type="submit" value="Buscar">
          </form>
        </div>
      </div>
    </div>
	<!--Crear una clase de Bootstrap llamada container para agregar un espaciado a nuestro contenido principal-->
	<div class="containerU p-4">
		<div class="row"> <!--las filas permiten dividir un contenido en multiples columnas,Bootstrap se compone de 12 columnas, se dividiras en este caso 5 columnas para el formulario y 7 para la tabla -->
			<div class="col-md-5">
				<!-- escribire mi formulario dentro de una tarjeta -->
				<div class="card">
					<!-- para el contenido creo la clase card-body -->
					<div class="card-body">
						<form id="task-form">
							<!-- Crear un input oculto, con un id para despues rellenar-->
							<input type="hidden" id = "taskId"> <!--Lo necesito para enviar (desde app.js) un ID al editar -->
							<!--Crear un div para dar un estilo, para dar una separacion entre inptus de un formulario-->
							<div class = "form-group" id="seccionRecargar">
								<!--Aqui muestro la publicacion seleccionada -->
								<input type = "text" id="name" placeholder="Imagen" class="form-control">
							</div>
						</form>
					</div>
				</div>

			</div>
			<div class="col-md-7">
			<!--Crear una pantalla que me muestre los resultados que esribo en el formulario-->
				<div class="card my-4" id="task-result">
					<div class="card-body">
						<ul id="container"><!--para que almacene todas la s tareas que genere durante la busqueda-->	
						</ul>
					</div>
				</div>
				<!-- Aqui crear la tabla** El contenido de la tabla sera del Servidor** -->
				<table class="table table-bordered table-sm"> <!--table-sm: para una tabla pequeña -->
					<thead> <!-- titulos -->
						<tr> <!-- Fila -->
							<td>Categoria</td> <!-- Celdas -->
							<td>Titulo</td>
							<td>Created by</td>
							<td>Imagen</td>
							<td>Descripcion</td>
						</tr>
					</thead>
					<tbody id="tasks"> <!--En tbody se recibiran los datos -->
						<?php 
							if(!isset($q2)){  
						 		die('Query Failed');
						    }
						    
						    $total =$q2->fetch();
						    if($total['total']<=0){
						        echo "No hay resultados de la busqueda";
						    }
						    else{
								while($row = $query->fetch()){ /*obtengo una fila por cada dato que obtengo de la BD*/
									$img = $row['ruta'];
									$taskId=$row['id_publicacion'];
									
									echo "<tr taskId = ".$taskId.">";
									echo "<td>".$row['categoria']."</td>";
									echo "<td>".$row['titulo']."</td>";
									echo "<td>".$row['nombre']."</td>";
									//echo "<div> <center>  <img src='archivos/$img' >  </div>"; 
									echo "<td>
										<a href = '#' class = 'task-item'> <img src='archivos/$img' style = 'height: 10%; width: 15%;'></a>
									</td>";
									echo "<td>".$row['texto']."</td>";
									echo "</tr>";
								}
						    }
						?>	
					</tbody>
				</table>	
			</div>
		</div>
	</div>
</body>
</html>