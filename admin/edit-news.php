<?php
	include('../Functions/initialize.php');
	
	if(isset($_SESSION['loggedInAdmin'])) {
		if($_SESSION['loggedInAdmin'] != TRUE) {
			header("Location: ../not-found");
		}
	} else {
		header("Location: ../not-found");
	}
	
	$id = $_GET['id'];
					
	$query = "SELECT * FROM news WHERE id='$id'";
	
	$result = mysqli_query($dbc, $query);
	$row = mysqli_fetch_assoc($result);
	
	if(isset($_POST['editNews'])) {
		$title = mysqli_real_escape_string($dbc,$_POST['title']);
		$content = mysqli_real_escape_string($dbc,$_POST['content']);
		
		if(strlen(trim($title)) == 0 || strlen(trim($content)) == 0) {
			echo "Fill all fields";
			mysqli_close($dbc);
			exit();
		}
		
		if(isset($_POST['top'])) {
			$query = "SELECT * FROM news ORDER BY id DESC LIMIT 1";
		
			$result = mysqli_query($dbc, $query);
			$lastID = mysqli_fetch_assoc($result)['id'];
			$topID = $lastID + 1;
		} else {
			$topID = $id;
		}
		
		$content = str_replace("\r\n", " <br> ", $content);
		
		$query = "UPDATE news SET title = '$title', content = '$content', id = '$topID' WHERE id='$id';";
		
		if(mysqli_query($dbc, $query)) {
			header("Location: /admin/edit-news?id=$topID");
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Edit news | The Artball</title>
		
		<?php
			include('header.php');
		?>
		
		<div class="container main-container">
			<div class="row">
				<div class="col-md-8 col-sm-8 col-xs-12">
					<form name="editNews" action="" method="POST">
						<label>Title:</label>
						<input type="text" name="title" class="input" value="<?php echo $row['title']; ?>">
						<label>Content:</label>
						<textarea cols='50' rows='18' name='content' class="input"><?php echo $row['content']; ?></textarea><br/>
						Set on top: <input type="checkbox" name="top">
						<input type="hidden" name="editNews" value="editNews">
						<input type="submit" value="Update">
					</form>
				</div>
			</div>
		</div>
	</body>
</html>