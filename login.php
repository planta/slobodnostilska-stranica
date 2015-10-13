<?php
	include("Functions/initialize.php");
	
	if(isset($_SESSION['loggedIn'])) {
		if($_SESSION['loggedIn']) {
			header("Location: index");
		}
	}
	
	if(!empty($_POST['registration'])) {
		$email = mysqli_real_escape_string($dbc, $_POST['email']);
		
		$query = "SELECT id FROM users WHERE email = '$email';";
		$result = mysqli_query($dbc, $query);
		
		if(mysqli_num_rows($result) > 0) {
			
		} else {
			$password = mysqli_real_escape_string($dbc, $_POST['password']);
			$salt = "ballarts";
			$hashPass = md5($password.$salt);
			
			$confirmationHash = md5($email.$salt);
			
			date_default_timezone_set("Europe/Zagreb");
			$currentDate = date("Y-m-d H:i:s");
			
			$query = "INSERT INTO users (email, password, registrationDate, confirmationHash) VALUES ('$email', '$hashPass', '$currentDate', '$confirmationHash');";
			$result = mysqli_query($dbc, $query);
			
			$userId = mysqli_insert_id($dbc);
			
			$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
								<html>
									<head>
										<meta name="viewport" content="width=device-width, initial-scale=1"/>
										<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
								
										<title>The Artball registration</title>
								
										<link href="https://fonts.googleapis.com/css?family=Roboto:400,300" rel="stylesheet" type="text/css">
								
										<style>
											* { font-family: "Roboto"; }
										</style>
									</head>
									<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
										<!-- HEADER -->
										<table width="600" align="center" style="margin-top: 6px;">
										    <tr>
										        <td>
										            <table width="600">
										                <tr>
										                    <td width="60"><a href="http://www.planntaseeds.com/"><img src="http://www.plantaseeds.com/Pictures/logo.png" width="60" height="60" class="logo"></a></td>
										                    <td><h1><a href="http://www.plantaseeds.com/" style="font-size: 22px; color: #000000; text-decoration: none; font-weight: 100; display: inline-table; margin-left: 8px;">PLANTA<span style="font-weight: normal;">SEEDS</span></a></h1></td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
										<!-- /HEADER -->
										<table border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="margin-top: 10px;">
										    <tr>
										        <td valign="top" width="100%">
										            <table border="0" cellpadding="10" cellspacing="0" width="100%">
										                <tr>
										                    <td style="padding: 0px;">
										                    	<h3 style="margin: 0px;">Hello</h3>
										                    </td>
										                </tr>
													</table>
												</td>
											</tr>
											<tr>
												<td valign="top" width="100%">
													<table border="0" cellpadding="10" cellspacing="0" width="100%">
										            	<tr>
															<a href="http://www.theartball.com/confirm-registration?id=' . $userId . '&hash=' . $confirmationHash . '" style="color: #408B17; text-decoration: none;">Click here to confirm your registration</a>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</body>
								</html>';
			
			$headers  = 'MIME-Version: 1.0' . PHP_EOL;
			$headers .= 'Content-Type: text/html; charset=UTF-8' . PHP_EOL;
			$headers .= 'From: Mario<mario@plantaseeds.com>' . PHP_EOL;
			
			if(!mail($email, "The Artball registration", $message, $headers)) {
				echo "nijePoslanMail";
			} else {
				echo "uspjesnoRegistriran";
			}
		}
	}
	
	if(!empty($_POST['login'])) {
		$email = mysqli_real_escape_string($dbc, $_POST['email']);
		$password = mysqli_real_escape_string($dbc, $_POST['password']);
		$salt = "ballarts";
		
		$hashPass = md5($password.$salt);
		
		$sql = "SELECT id, role FROM users WHERE email=? AND password=?";
		//initialize statement object on connection
		$stmt = mysqli_stmt_init($dbc);
		//bind statement object parameters with the query
		if (mysqli_stmt_prepare($stmt, $sql)) {
			//bind parameters and their types with the statement object
			mysqli_stmt_bind_param($stmt, 'ss', $email, $hashPass);
		    //execute prepared query
		    mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
		}
		
		mysqli_stmt_bind_result($stmt, $userId, $userRole);
		mysqli_stmt_fetch($stmt);
		
		if (mysqli_stmt_num_rows($stmt) > 0) {
			//succesful login
			$_SESSION['loggedIn'] = TRUE;
			
			if($userRole == "admin") {
				$_SESSION['loggedInAdmin'] = TRUE;
			}
			
			header("Location: admin/index");
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login | The Artball</title>
		
		<meta name="keywords" content="the artball, artball, freestyle football, football, freestyle, ball, tricks, skills">
		<meta name="description" content="Login/register to join a passionate community of freestyle footballers from all around the world.">
		
		<?php
			include("Templates/header.php");
		?>
		
		<div class="container">
			<div class="row" style='margin-top:80px;'>
				<div class="col-md-offset-1 col-md-5 col-sm-6 col-xs-12">
					<div class="login">
						<h1>Login</h1>
						<p>Log in to join a passionate community of freestyle footballers from all around the world.</p>
						<form name="login" action="" method="POST">
							<input type="text" name="email" placeholder="Email" class="input">
							<input type="password" name="password" placeholder="Password" class="input">
							<input type="hidden" name="login" value="login">
							<input type="submit" value="Login">
						</form>
						<a href="forgotten-password">Forgot your password?</a>
					</div>
				</div>
				<div class="col-md-5 col-sm-6 col-xs-12">
					<div class="registration">
						<h2>Registration</h2>
						<p>Register to join a passionate community of freestyle footballers from all around the world.</p>
						<form name="registration" action="" method="POST" id="registerForm">
							<input type="email" name="email" placeholder="Email" class="input" id="email" onfocus="highlightField(this);" onblur="validateEmail(this);">
							<input type="password" name="password" placeholder="Password" class="input" id="password" onfocus="highlightField(this);" onblur="clearField(this);">
							<input type="password" name="repeatPassword" placeholder="Repeat password" class="input" id="passwordCheck" onfocus="highlightField(this);" onblur="checkRepeatPassword();">
							<input type="hidden" name="registration" value="registration">
							<input type="submit" value="Register">
						</form>
					</div>
				</div>
			</div>
		</div>
		
		<?php
			include("Templates/footer.php");
		?>
	</body>
</html>