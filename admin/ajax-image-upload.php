<?php
	include("../Functions/initialize.php");
	
	$imageURL = $_POST['imageURL'];
	$imageName = $_POST['name'];
	
	if(!empty($imageURL)) {
		if(empty($imageName)){
			echo "Insert image name.";
			exit();
		}
		$imageName = $imageName . '.jpg';
		if(file_exists("../images/" . $imageName)) {
			echo "Sorry, image already exists.";
		} else {
			copy($imageURL, '../images/' . $imageName);
			$query = "INSERT INTO images (name) VALUES ('$imageName');";
			$result = mysqli_query($dbc, $query);
			
			echo "Uploaded image URL is:<br/>http://www.theartball.com/images/" . $imageName;
		}
	}

	if(!empty($_POST['uploadImage'])) {
		print_r($_FILES);
		if(is_uploaded_file($_FILES['image']['tmp_name'])) {
			echo "test";
			if (file_exists('../images/' . $_FILES['image']['name'])) {
			    echo "Sorry, image already exists.";
			} else {
				move_uploaded_file($_FILES['image']['tmp_name'], '../images/' . $_FILES['image']['name']);

				$imageName = $_FILES['image']['name'];

				$query = "INSERT INTO images(name) VALUES ('$imageName');";
				$result = mysqli_query($dbc, $query);

				echo "Uploaded image URL is:<br/>http://www.theartball.com/images/" . $imageName;
			}
		} else {
			echo "upload failed";
		}
	}
?>