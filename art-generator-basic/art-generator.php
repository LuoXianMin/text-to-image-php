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
	<h1>Seed Art Generator</h1>
	<p>Enter some words and wait for magic...</p>
	<hr>
</div>

<!-- Form -->
<div class="container-fluid" style="margin:0 auto; width: 90%;">
	<div class="row">
		<div class="col-md-8">
			<div class="form-group">
				<form action="art-generator.php" method="POST">
					<input class="form-control" type="text" name="string" placeholder="Enter some text" maxlength="100"> <br>
					<button class="btn btn-default" name="submit">Generate!</button>
				</form>
			</div>			
		</div>
	</div>
</div>

<br><br>

<?php
/* Process form and generate image for download */

if (isset($_POST['submit']) === true && empty($_POST['submit']) === true && empty($_POST['string']) === false) {
	
	
	$string = $_POST['string']; // Sanitize this input if you make it public!
	
	// Generate Image
	$image = imagecreate(200, 200);
	$bg_color = imagecolorallocate($image, 255, 153, 51);
	$string_color = imagecolorallocate($image, 255, 255, 255);
	$line_color = imagecolorallocate($image, 0, 0, 0);
	imagestring($image, 20, 20, 20, $string, $string_color);
	imagesetthickness ($image, 5);
	imageline($image, 30, 45, 165, 45, $line_color);
	imageline($image, 200, 100, 100, 100, $line_color);
	imageline($image, 0, 444, 90, 55, $line_color);	
	
	// Push image to header
	header('Content-type: image/png');
	$url = (time() . $string) . '.png';
	
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
	<div class='row'><h3>Here's your image:</h3><br></div>
		<div class='row'>
			<div class='col-md-8'>
				<img src='" . $image_file . "' alt='' width='200px' height='200px'>
			</div>
		</div>
	</div>
	";
	}


?>

</body>
</html>
