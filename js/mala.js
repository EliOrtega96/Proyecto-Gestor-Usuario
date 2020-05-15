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
				var img = data['img'];

					$('#'+id).html(img);
			}
		});

	});

});