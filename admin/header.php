	<!-- <meta charset="UTF-8"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Mario Plantosar">
	
	<link rel="icon" type="image/ico" href="/Pictures/favicon.ico">
	
	<link rel="stylesheet" type="text/css" href="../Style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../Style/style.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<script src="../Functions/jquery-1.11.3.min.js"></script>
	<script src="required.js"></script>
	
	<?php
		//include_once("Functions/googleAnalytics.php");
	?>
	
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<header>
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 top-header">
					<a href="/" class="logo">The Artball</a>
					
					<label for="menuCheckbox" class="menuToggle">Menu</label>
	      			<input type="checkbox" id="menuCheckbox">
					
					<nav class="navigation">
						<ul class="menu">
							<li><a href="add-news">Add news</a></li>
							<li><a href="add-article">Add article</a></li>
							<li><a href="image-gallery">Image gallery</a></li>
							<li><a href="list-news">Edit news</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</header>
	
	<a href="logout.php" style="position: absolute; top: 100px; left: 0px;">Logout</a>
