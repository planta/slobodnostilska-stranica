<?php
	include("../Functions/initialize.php");
	
	if(isset($_SESSION['loggedInAdmin'])) {
		if($_SESSION['loggedInAdmin'] != TRUE) {
			header("Location: ../not-found");
		}
	} else {
		header("Location: ../not-found");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Add article | The Artball</title>
		
		<?php
			include('header.php');
		?>
			
		<?php
			if(!empty($_POST['addArticle'])) {
				$title = mysqli_real_escape_string($dbc,$_POST['title']);
				$content = mysqli_real_escape_string($dbc,$_POST['content']);
				$author = $_POST['author'];
				$date = date("d/m/Y");
				
				if(strlen(trim($title)) == 0 || strlen(trim($content)) == 0 || strlen(trim($author)) == 0) {
					echo "Fill all fields.";
					mysqli_close($dbc);
					exit();
				}
				
				if(is_uploaded_file($_FILES['file']['tmp_name'])) {
					move_uploaded_file($_FILES['file']['tmp_name'], "../images/" . $_FILES['file']['name']);
					$imageURL = "http://www.theartball.com/images/" . $_FILES['file']['name'];
				} else if(!empty($_POST['imageURL'])) {
					$imageURL = $_POST['imageURL'];
				} else {
					echo "Upload image or insert image URL.";
					mysqli_close($dbc);
					exit();
				}
				
				$content = str_replace('\r\n', " <br> ", $content);
			
				$sql = "INSERT INTO articles (title, content, author, image, date) VALUES ('$title', '$content', '$author', '$imageURL', '$date');";
			
				if(mysqli_query($dbc, $sql)) {
					echo "Article has been succesfully added. Thank You.";
				}
			}
		?>
		
		<div class="container main-container">
			<div class="row">
				<div class="col-md-8 col-sm-8 col-xs-12">
					<h1>Add article</h1>
					<form name="addNews" method="post" action="" enctype="multipart/form-data">
						<label>Title:</label>
						<input type="text" name="title" class="input">
						<label>Content:</label>
						<textarea name="content" rows="18" class="input"></textarea>
						<br/>
						<label>Author:</label>
						<input type="text" name="author" class="input">
						<br/>
						<label>Article Image:</label>
						<p><i>Note: Please be sure picture is in square ratio (e.g. 400x400 pixels)</i></p>
						<label>ImageLink:</label>
						<input type="url" name="imageURL" class="input">
						<label>Or Upload image:</label>
						<input type="file" name="file">
						<input type="hidden" name="addArticle" value="addArticle">
						<input type="submit" value"Submit" class="btn-submit">
					</form>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12 ajax-image-upload">
					<form name="uploadImage" action="" method="POST" enctype="multipart/form-data" id="ajaxImageUpload">
						<label for="name">Image name:</label>
						<input type="text" name="name"><br>
						<label for="imageURL">Image URL</label>
						<input type="url" name="imageURL"><br>
						<label for="image">Image</label>
						<input type="file" name="image" id="image">
						<input type="hidden" name="uploadImage" value="uploadImage">
						<input type="submit" value="upload" class="btn-submit">
					</form>
					
					<h4 class="ajax-link"></h4>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<ul>
						<li>Image as close to square as possible (eg 300x300 pixels)</li>
						<li>To include video/photo just paste url inside news content</li>
						<li>Italic: put text inside &lt;i&gt;text&lt;/i&gt;</li>
						<li>Bold: put text inside &lt;b&gt;text&lt;/b&gt;</li>
						<li>Underline: put text inside &lt;u&gt;text&lt;/u&gt;</li>
					</ul>
				</div>
			</div>
		</div>
	
	<?php
		include("/Templates/footer.php");
	?>