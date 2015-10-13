<?php
	include("Functions/initialize.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Confirm registration | The Artball</title>
		
		<meta name="robots" content="noindex">
		
		<?php
			include("Templates/header.php");
		?>
		
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Confirm registration</h1>
				</div>
				
				<?php
					$userId = $_GET['id'];
					$confirmationHash = $_GET['hash'];
					
					$query = "UPDATE users SET confirmedAccount = 1 WHERE confirmationHash = '$confirmationHash';";
					$result = mysqli_query($dbc, $query);
					
					if(mysqli_affected_rows($dbc) != 0) {
						$_SESSION['loggedIn'] = TRUE;
						
						echo '<p>Confirmed account</p>';
					}
				?>
			</div>
		</div>
		
		<?php
			include("Templates/footer.php");
		?>
	</body>
</html>