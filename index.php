<?php
	include("Functions/initialize.php");

	if(!empty($_POST['subscribe'])) {
		$email = mysqli_real_escape_string($dbc, $_POST['email']);

		$query = "SELECT id FROM subscribers WHERE email = '$email';";
		$result = mysqli_query($dbc, $query);

		if(mysqli_num_rows($result) == 0) {
			$salt = "theartballers";
			$hash = md5($email.$salt);

			$query = "INSERT INTO subscribers (email, hash) VALUES ('$email', '$hash');";
			$result = mysqli_query($dbc, $query);
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
<title>Coming Soon</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" >
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css">
body {
  /*background: linear-gradient(90deg, white, gray);*/
  background-color: #eee;
  background:url('http://www.theartball.com/images/artball-back.png');
  background-size: cover;
}

body, h1, p {
  font-family: "Helvetica Neue", "Segoe UI", Segoe, Helvetica, Arial, "Lucida Grande", sans-serif;
  font-weight: normal;
  margin: 0;
  padding: 0;
  text-align: center;
}

.container {
  margin-left:  auto;
  margin-right:  auto;
  margin-top: 177px;
  max-width: 870px;
  padding-right: 15px;
  padding-left: 15px;
  padding-bottom: 15px;
  /*background: red;*/
}

.row:before, .row:after {
  display: table;
  content: " ";
}

h1 {
  font-size: 48px;
  font-weight: 300;
  margin: 0 0 20px 0;
}

.lead {
  font-size: 21px;
  font-weight: 200;
  margin-bottom: 20px;
}

p {
  margin: 0 0 10px;
}

a {
  color: #3282e6;
  text-decoration: none;
}

#emailField {
  width: 340px; height: 50px; font-size: 1.1em; padding: 0px 12px 0px 12px; margin: 20px 0px 0px 0px; border: 1px solid #DBDADA; border-bottom: 4px solid #DBDADA;
}
#subscribeButton {
  font-weight: normal; color: white; background: rgb(11,129,228); height: 50px; width: 180px; font-size: 1.0em; font-weight: bold; cursor: pointer; padding-top: 6px; margin: 20px 0px 0px 8px; border: none; border-bottom: 4px solid rgb(1,109,208); text-transform: uppercase;
}
</style>
</head>

<body>
<div class="container text-center" id="error">

  <svg height="100" width="100">
    <circle cx="50" cy="50" r="31" stroke="rgb(11,129,228)" stroke-width="9.5" fill="none" />
    <circle cx="50" cy="50" r="6" stroke="rgb(11,129,228)" stroke-width="1" fill="rgb(11,129,228)" />
    <line x1="50" y1="50" x2="35" y2="50" style="stroke:rgb(11,129,228);stroke-width:6" />
    <line x1="65" y1="35" x2="50" y2="50" style="stroke:rgb(11,129,228);stroke-width:6" />
    <path d="M59 65 L83 65 L75 87 Z" fill="rgb(11,129,228)" />
    <rect width="20" height="9" x="70" y="56" style="fill:rgba(0,0,0,0);stroke-width:0;" />
  </svg>
  <div class="row">
    <div class="col-md-12">
      <div class="main-icon text-success"><span class="uxicon uxicon-clock-refresh"></span></div>
      <h1>Website under construction.</h1>
      <p class="lead">While we make it as awesome as we can, subscribe to <br> our newsletter and we'll let you know when it's ready. Or download app <br>
      by clicking suitable phone!</p>
      <form name="newsletter" action="" method="POST" class="col-md-7 col-sm-7 col-xs-12">
        <input type="email" name="email" id="emailField" placeholder="E-mail">
        <input type="hidden" name="subscribe" value="subscribe">
        <input type="submit" id="subscribeButton" value="Subscribe">
      </form>

      <?php
        if(!empty($_POST['subscribe'])) {
          echo '<p style="margin-top: 20px;">Thank you for subscribing!</p>';
        }
      ?>
    </div>
  </div>

</div>

</body>
</html>