<?php
	include("Functions/initialize.php");
	
	if(!empty($_POST['new-listing'])) {
		$title = $_POST['title'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$seller = $_POST['seller'];
		$contact = $_POST['contact'];
		$location = $_POST['location'];

		$query = "INSERT INTO listings (title, description, price, seller, location, contact, date) VALUES ('$title', '$description', '$price', '$seller', '$location', '$contact', CURDATE());";
		$result = mysqli_query($dbc, $query);
		$listingId = mysqli_insert_id($dbc);

		if(is_uploaded_file($_FILES['image1']['tmp_name'])) {
			$supportedExtensions = array("jpeg", "jpg", "png");
			$file_name = $_FILES["image1"]["name"];
			$extension = pathinfo($file_name, PATHINFO_EXTENSION);

			if(in_array($extension, $supportedExtensions)) {
				echo "in array";

				move_uploaded_file($_FILES['image1']['tmp_name'], "listing-images/" . $_FILES['image1']['name']);
				$imageURL = "http://www.theartball.com/listing-images/" . $_FILES['image1']['name'];
				
				$mainImageQuery = "UPDATE listings SET image = '$imageURL' WHERE id = '$listingId';";
				$mainImageResult = mysqli_query($dbc, $mainImageQuery);

				$subImageQuery = "INSERT INTO listing_images (image, listing) VALUES ('$imageURL', '$listingId');";
				$subImageResult = mysqli_query($dbc, $subImageQuery);
			}
		} else {
			$imageURL = "http://www.theartball.com/listing-images/placeholder.png";
			$mainImageQuery = "UPDATE listings SET image = '$imageURL' WHERE id = '$listingId';";
			$mainImageResult = mysqli_query($dbc, $mainImageQuery);

			$query = "INSERT INTO listing_images (image, listing) VALUES ('$imageURL', '$listingId');";
			$result = mysqli_query($dbc, $query);
		}

		if(is_uploaded_file($_FILES['image2']['tmp_name'])) {
			$supportedExtensions = array("jpeg", "jpg", "png");
			$file_name = $_FILES["image2"]["name"];
			$extension = pathinfo($file_name, PATHINFO_EXTENSION);

			if(in_array($extension, $supportedExtensions)) {
				move_uploaded_file($_FILES['image2']['tmp_name'], "listing-images/" . $_FILES['image2']['name']);
				$imageURL = "http://www.theartball.com/listing-images/" . $_FILES['image2']['name'];
				
				$subImageQuery = "INSERT INTO listing_images (image, listing) VALUES ('$imageURL', '$listingId');";
				$subImageResult = mysqli_query($dbc, $subImageQuery);
			}
		}

		if(is_uploaded_file($_FILES['image3']['tmp_name'])) {
			$supportedExtensions = array("jpeg", "jpg", "png");
			$file_name = $_FILES["image3"]["name"];
			$extension = pathinfo($file_name, PATHINFO_EXTENSION);

			if(in_array($extension, $supportedExtensions)) {
				move_uploaded_file($_FILES['image3']['tmp_name'], "listing-images/" . $_FILES['image3']['name']);
				$imageURL = "http://www.theartball.com/listing-images/" . $_FILES['image3']['name'];
				
				$subImageQuery = "INSERT INTO listing_images (image, listing) VALUES ('$imageURL', '$listingId');";
				$subImageResult = mysqli_query($dbc, $subImageQuery);
			}
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Add listing | The Artball</title>
		
		<meta name="keywords" content="the artball, artball, freestyle football, football, freestyle, ball, tricks, skills">
		<meta name="description" content="Have something to sell? Make a listing here so buyers can find you.">
		
		<?php
			include("Templates/header.php");
		?>
		
		<div class="container main-container">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12 add-listing">
					<h1>Add listing</h1>
					<form name="add-listing" action="" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<label for="title">Title:</label><br/>
								<input type="text" name="title" placeholder="Adidas Europass matchball, Nike Elastico shoes etc..." class="input" id="title">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<label for="description">Description:</label><br/>
								<textarea name="description" id="description" placeholder="Brand new never used Adidas Teamgeist..." class="input"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-12">
								<button class="image-upload-button image1-button">Image 1</button>
								<input type="file" name="image1" id="image1-upload">
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<button class="image-upload-button image2-button">Image 2</button>
								<input type="file" name="image2" id="image2-upload">
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<button class="image-upload-button image3-button">Image 3</button>
								<input type="file" name="image3" id="image3-upload">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<label for="price">Price:</label><br/>
								<input type="text" name="price" placeholder="$100" class="input" id="price">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<label for="seller">Seller:</label><br/>
								<input type="text" name="seller" placeholder="John Doe, Jane Doe..." class="input" id="seller">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<label for="contact">Contact:</label><br/>
								<input type="text" name="contact" placeholder="contact@contact.com" class="input" id="contact">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<label for="location">Location:</label><br/>
								<input type="text" name="location" placeholder="London, UK" class="input" id="location">
							</div>
						</div>
						<input type="hidden" name="new-listing" value="new-listing">
						<input type="submit" value="Submit" class="btn-submit">
					</form>
				</div>
			</div>
		</div>
		
		<?php
			include("Templates/footer.php");
		?>
	</body>
</html>