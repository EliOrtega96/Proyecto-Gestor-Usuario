$(document).ready(function() {

	$(".bien").click(function() {

		var id = this.id; // obtenemos la id
		var tip = 1; 
		// AJAX

		$.ajax({
			url: 'bien.php',
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