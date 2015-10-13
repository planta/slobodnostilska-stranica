$(window).load(function() {
	if($(window).width() < 768) {
		
	}
	
	$('#ajaxImageUpload').submit(function(event) {
		event.preventDefault();
		
		$.ajax({
			type: 'POST',
			url: '/Functions/ajax-functions.php',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false
		}).done(function(data) {
			$('.ajax-link').html(data).fadeIn();
		});
	});
});