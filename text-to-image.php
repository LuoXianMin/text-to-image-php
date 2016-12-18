<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, minimumscale=1.0, maximumscale=1.0">
	<title>ART GENERATOR</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>

<body>
	<!-- Header -->
	<div class="container-fluid" style="margin:0 auto; width: 90%;">
		<h1><a href="text-to-image.php">Text-to-image</a></h1>
		<hr>
	</div>
	<!-- Form -->
	<div class="container-fluid" style="margin:0 auto; width: 90%;">
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<form action="" method="POST">
						<textarea class="form-control" type="text" name="string" placeholder="Enter some text" maxlength="300"></textarea>
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
	
	
	$string = $_POST['string'];
	$str = str_split($string, 50);
	//print_r($str);
	
	//25-px per line
	$adjustedHeight = count($str) * 20;
	
	// Generate Image
	$image = imagecreate(500, $adjustedHeight);
	$bg_color = imagecolorallocate($image, 255, 255, 255);
	$string_color = imagecolorallocate($image, 0, 0, 0);	
	$font_height = imagefontheight(20);
	imagesetthickness ($image, 5);
	
	// Loop to make new lines
	for ($x = 0; $x <= count($str) - 1; $x++) {
		imagestring($image, 20, 30, $y, $str[$x], $string_color);
		$y += 20;
	}
		
	// Push image to header
	header('Content-type: image/png');
	$url = (time()*rand(1, 5)) . '.png';
	
	// If image is stored, redirect with GET parameter
	if (imagepng($image, $url)) {
	header('Location: ?file=' . $url);
	exit();
	}
	}
	
	
	// Get image file path from $_GET and display it
	if (isset($_GET['file']) === true && empty($_GET['file']) === false) {
	$image_file = $_GET['file']; // Sanitize this input if you make it public!
	
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