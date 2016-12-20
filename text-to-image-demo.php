<?php

include 'text-to-image.php';


?>

<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, minimumscale=1.0, maximumscale=1.0">
	<title>Text to image demo</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>

<body>
	<!-- Header -->
	<div class="container-fluid" style="margin:0 auto; width: 90%;">
		<h1><a href="text-to-image-demo.php">Text-to-image-demo</a></h1>
		<hr>
	</div>
	<!-- Form -->
	<div class="container-fluid" style="margin:0 auto; width: 90%;">
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<form action="" method="POST">
						<textarea class="form-control" type="text" name="string" placeholder="Enter some text" style="height:90px;" maxlength="300"></textarea>
						<label>300 char limit</label>
						<br>
						<br>
						<button class="btn btn-default" name="submit">Convert to image!</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<br>
	<br>
	
	<?php
	/* Process form and generate image for download */
	if (isset($_POST['submit']) === true && empty($_POST['submit']) === true && empty($_POST['string']) === false) {
	
	$image = new image;
	$string = $_POST['string'];
	$image->makeImageFromString($string);
		
	}
	
	/* Optional. Gets parameter 'file' value and displays image at that url */
	// Get image file path from $_GET and display it
	if (isset($_GET['file']) === true && empty($_GET['file']) === false) {
	$image_file = $_GET['file'];
	
	echo "
		<div class='container-fluid' style='margin:0 auto; width: 90%;'>
			<div class='row'>
				<h3>Here's your image:</h3>
				<br>
			</div>
			<div class='row'>
				<div class='col-md-8' style=''>
					<img src='" . $image_file . "' style='border:1px solid black;'>
				</div>
			</div>
		</div>
		<br>
	";
	}
	
	?>

</body>

</html>