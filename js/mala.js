$(document).ready(function() {

	$(".mal").click(function() {

		var id = this.id; // obtenemos la id
		var tip = 3; 
		// AJAX

		$.ajax({
			url: 'mal.php',
			type: 'post',
			data: {id:id,tip},
			dataType: 'json',
			success: function(data) {
				let postId = id.replace(/\D/g,'');/*Obtenemos el ID*/
				$("#conteo").load('contarReacciones.php',{postId});/*Actualizamos el conteo que aparece abajo de los emojis*/
				$("#reaccionesP").load('ActualizaReaccion.php',{postId});/*Actualizamos la reaccion de los emojis (cuando busca por usuario)*/
				$("#reaccionesPP").load('ActualizaReaccionPrinc.php',{postId});/*Actualizamos la reaccion de los emojis en la pagina principal (registrado.php)*/

				var img = data['img'];
				$('#'+id).html(img);

			}
		});
	});
});