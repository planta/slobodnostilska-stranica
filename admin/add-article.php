<?php

	header('Content-Type: text/html; charset=utf-8');
	$dbc = mysqli_connect('localhost', 'artballer', 'Artball17', 'theartball') or die("It's not you, it's us! Our database doesn't work at the moment, please come back in a few minutes.");

	

	$title = mysqli_real_escape_string($dbc,$_POST['title']);
	$content = mysqli_real_escape_string($dbc, $_POST['content']);
	$imageURL = $_POST['imageURL'];
	$author = $_POST['author'];
	$date = date("d/m/Y");

	//uploaded picture
	$image_file_name=$_FILES['file']['name'];
	$image_file_size=$_FILES['file']['size'];
	$image_file_type=$_FILES['file']['type'];
	$image_file_tmpname=$_FILES['file']['tmp_name'];

	$image_file_location="Images/".str_replace(" ", "", $image_file_name);

	if(strlen(trim($title))===0 || strlen(trim($content))===0 || strlen(trim($author))===0){
		echo "Fill all fields.";

		mysqli_close($dbc);
		exit();
	}

	if(strlen(trim($imageURL))===0 && strlen(trim($image_file_name))===0){
		echo "Upload image or insert image URL.";
		mysqli_close($dbc);
		exit();
	}

	if(strlen(trim($image_file_name))!=0){
		move_uploaded_file($image_file_tmpname, $image_file_location);
		$imageURL="http://localhost/apptest/".$image_file_location;
	}

	// $content=strip_tags($content);
	$content = str_replace('\r\n', " <br> ", $content);
	// $content = strtr($content, 
	//   "ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÑÒÓÔÕÖØÝßàáâãäåçèéêëìíîïñòóôõöøùúûüýÿ",
	//   "AAAAAACEEEEIIIINOOOOOOYSaaaaaaceeeeiiiinoooooouuuuyy"); 

	//mysql_query("SET NAMES 'utf8'");
	$sql="INSERT INTO articles (title, content, author, image, date) VALUES ('$title','$content','$author','$imageURL','$date')";

		if(mysqli_query($dbc, $sql)){
			echo "Article has been succesfully added. Thank You.";
			echo "<br><br><a href='http://www.theartball.com/admin/news.php'>Add news!</a>";
			echo "<br><br><a href='http://www.theartball.com/admin/articles.php'>Add article!</a>";
		}
	
	mysqli_close($dbc);
?>