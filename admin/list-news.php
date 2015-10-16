<?php
	include("../Functions/initialize.php");
	
	if(isset($_SESSION['loggedInAdmin'])) {
		if($_SESSION['loggedInAdmin'] != TRUE) {
			header("Location: ../not-found");
		}
	} else {
		header("Location: ../not-found");
	}

	if(!empty($_POST['delete-id'])) {
		$id = $_POST['delete-id'];
		$query = "DELETE FROM news WHERE id = '$id';";
		$result = mysqli_query($dbc, $query);
	}

	$query = "SELECT * FROM news ORDER BY id DESC;";
	$result = mysqli_query($dbc, $query);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>News list | The Artball</title>
	
		<?php
			include("header.php");
		?>
		
		<div class="container main-container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 news-list">
					<ul>
						<?php
							while($row = mysqli_fetch_assoc($result)) {
						?>
								<li>
									<a href="edit-news.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
									<form name="delete" action="" method="POST">
										<input type="hidden" name="delete-id" value="<?php echo $row['id']; ?>">
										<input type="submit" value="Delete article">
									</form>
								</li>
						<?php
							}
						?>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>