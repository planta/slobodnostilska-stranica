$(window).load(function() {
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

	$('.news-list input[type="submit"]').click(function(event) {
		if(!confirm("Are you sure you want to delete this article?")) {
			event.preventDefault();
		}
	});
});