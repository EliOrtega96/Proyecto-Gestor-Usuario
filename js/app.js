$(document).ready(function() {
	let edit = false; /*Cuando el usuario de clic en un elemento cambia a TRUE*/
	console.log('jQuery is working'); 
	
	Mostrar();

	function Mostrar(){
		/*PARA REACCIONES*/
		if (edit) {
			let postId = $('#taskId').val();
			console.log(postId);
			$(function(){
				$('#seccionRecargar').load('prueba_reacciones.php',{postId});
			});
		}
	}
	
	/*Editar dando click en name, escuchar ese evento task-item*/
	$(document).on('click', '.task-item', function(){
		/*console.log('editing');*/
		/*Enviar el id al backend y los nuevos datos*/
		let element = $(this)[0].parentElement.parentElement;/*Seleccionar el primer elemento del elemento 0, su padre (td) -> su padre (tr)*/
		/*console.log(element);*/
		let id = $(element).attr('taskId'); /*->su atributo taskId*/ 		/*Seleccionar el ID*/
		/*console.log(id);*/
		/*Enviar el ID al servidor con post para que me retorne los datos de esa tarea y rellene en el formulario y luego cambiarlos,al task_single*/
		$.post('task_single.php', {id}, function(response){
			console.log(response);
			/*Convertir en un json la respuesta*/
			const task = JSON.parse(response);
			/*Mostrar en el formulario*/
			$('#name').val(task.name); /*name y description que declare en el formulario*/
			/*Rellenar el taskId para poder enviar el ID al editar*/
			$('#taskId').val(task.id); /*-- Cambio la manera de enviar los datos en el task-form -- */
			edit = true; /*Cuando el usuario de clic en un elemento cambia a TRUE*/
			Mostrar();
		})

	});
});
