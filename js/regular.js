$(document).ready(function() {

	$(".regular").click(function() {

		var id = this.id; // obtenemos la id
		var tip = 2; 
		// AJAX

		$.ajax({
			url: 'regular.php',
			type: 'post',
			data: {id:id,tip},
			dataType: 'json',
			success: function(data) {
				let postId = id.replace(/\D/g,'');
				$("#conteo").load('contarReacciones.php',{postId});/*Obtenemos el ID*/
				$("#reaccionesP").load('ActualizaReaccion.php',{postId});/*Actualizamos la reaccion de los emojis (cuando busca por usuario)*/
				$("#reaccionesPP").load('ActualizaReaccionPrinc.php',{postId});/*Actualizamos la reaccion de los emojis en la pagina principal (registrado.php)*/
				
				var img = data['img'];
				$('#'+id).html(img);
			}
		});
	});
});
