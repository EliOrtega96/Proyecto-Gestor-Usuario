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
				var img = data['img'];

					$('#'+id).html(img);
			}
		});

	});

});
