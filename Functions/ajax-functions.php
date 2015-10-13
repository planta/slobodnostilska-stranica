<?php
	include("initialize.php");

	if(!empty($_POST['uploadImage'])) {
		$imageURL = $_POST['imageURL'];
		$imageName = $_POST['name'];
		
		if(!empty($imageURL)) {
			if(empty($imageName)) {
				echo "Image name is required!";
			} else {
				$completeImageName = $imageName . '.jpg';
				copy($imageURL, '../images/' . $completeImageName);
				$query = "INSERT INTO images (name) VALUES ('$completeImageName');";
				$result = mysqli_query($dbc, $query);
				
				echo "Uploaded image URL is:<br/>http://www.theartball.com/images/" . $completeImageName;
			}
		} else if(is_uploaded_file($_FILES['image']['tmp_name'])) {
			if (file_exists('../images/' . $_FILES['image']['name'])) {
			    echo "Sorry, image already exists.";
			} else {
				move_uploaded_file($_FILES['image']['tmp_name'], '../images/' . $_FILES['image']['name']);

				$imageName = $_FILES['image']['name'];

				$query = "INSERT INTO images (name) VALUES ('$imageName');";
				$result = mysqli_query($dbc, $query);

				echo "Uploaded image URL is:<br/>http://www.theartball.com/images/" . $imageName;
			}
		} else {
			echo "There was an error, please try again.";
		}
	}
?>