$(window).load(function() {
	// Listing image upload
	$('.add-listing .image1-button').click(function(event) {
		event.preventDefault();
		$('.add-listing #image1-upload').click();
	});
	$('.add-listing .image2-button').click(function(event) {
		event.preventDefault();

		if($('.add-listing #image1-upload').get(0).files.length === 0) {
			$('.add-listing #image1-upload').click();
		} else {
			$('.add-listing #image2-upload').click();
		}
	});
	$('.add-listing .image3-button').click(function(event) {
		event.preventDefault();

		if($('.add-listing #image1-upload').get(0).files.length === 0) {
			$('.add-listing #image1-upload').click();
		} else if($('.add-listing #image2-upload').get(0).files.length === 0) {
			$('.add-listing #image2-upload').click();
		} else {
			$('.add-listing #image3-upload').click();
		}
	});

	$('.add-listing #image1-upload').change(function(event) {
		event.preventDefault();

		$('.add-listing .image1-button').html('Uploaded!').css('background', '#008AE5');
	});

	$('.add-listing #image2-upload').change(function(event) {
		event.preventDefault();

		$('.add-listing .image2-button').html('Uploaded!').css('background', '#008AE5');
	});
	$('.add-listing #image3-upload').change(function(event) {
		event.preventDefault();

		$('.add-listing .image3-button').html('Uploaded!').css('background', '#008AE5');
	});
});