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
	<head>
		<title>The Artball | Image Gallery</title>
		
		<?php
			include("header.php");
		?>
		
		<div class="container main-container">
			<div class="row">
				<?php 
					$query = "SELECT * FROM images";
					
					$result = mysqli_query($dbc, $query);
					
					while($row=mysqli_fetch_assoc($result)) {
						$imageUrl = "http://www.theartball.com/images/" . $row['name'];
				?>
						<div class="col-md-3 col-sm-4 col-xs-12 image-cell">
							<a href="<?php echo $imageUrl; ?>"><img src="<?php echo $imageUrl; ?>"/></a>
						</div>
				<?php
					}
				?>
			</div>
		</div>
	</body>
</html>