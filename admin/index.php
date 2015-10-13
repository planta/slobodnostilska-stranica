<?php
	include("../Functions/initialize.php");
	
	if(isset($_SESSION['loggedInAdmin'])) {
		if($_SESSION['loggedInAdmin'] != TRUE) {
			header("Location: ../not-found");
			echo "nope";
		}
		echo "test";
	} else {
		header("Location: ../not-found");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Admin | The Artball</title>
		
		<?php
			include("header.php");
		?>
			
			<div class="container">
				<div class="row">
					
				</div>
			</div>
			
		<?php
			include("/Templates/footer.php");
		?>