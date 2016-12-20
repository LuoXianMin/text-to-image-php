<?php

class image {


	public $nullImage;
	

	function makeImageFromString($string) {
	
	
		$str = str_split($string, 50);
		
		// Adjust height
		$adjustedHeight = count($str) * 20;
		
		// Generate Image
		$image = imagecreate(500, $adjustedHeight);
		$bg_color = imagecolorallocate($image, 255, 255, 255);
		$string_color = imagecolorallocate($image, 0, 0, 0);	
		$font_height = imagefontheight(20);
		imagesetthickness ($image, 5);
		
		// Loop to break lines in image
		for ($x = 0; $x <= count($str) - 1; $x++) {
			imagestring($image, 20, 30, $y, $str[$x], $string_color);
			$y += 20;
		}
		
		// Push image to header (save image to folder)
		header('Content-type: image/png');
		$url = (time()*rand(1, 5)) . '.png';
		
		// If image is stored, redirect with GET parameter (displays the file path of the image in the url)
		if (imagepng($image, $url)) {
			header('Location: ?file=' . $url);
			exit();
		}

	
	}

}