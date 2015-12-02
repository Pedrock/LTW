<?php
function createjpeg($source, $destination, $max_dimension = 1024)
{
	list($width, $height, $type, $attr) = ($image_info = getimagesize($source));
	if (!$image_info) return false;
	$factor = min(1,$max_dimension/max($width,$height));
	switch ($type)
	{
		case IMAGETYPE_GIF:
			$image = imagecreatefromgif($source);
		break;
		case IMAGETYPE_JPEG:
			$image = imagecreatefromjpeg($source);
		break;
		case IMAGETYPE_PNG:
			$image = imagecreatefrompng($source);
		break;
		default: return false;
	}
	$newwidth = $width*$factor;
	$newheight = $height*$factor;
	$new_image = imagecreatetruecolor($newwidth,$newheight);
	imagealphablending($new_image, false);
    imagecopyresized($new_image, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    return imagejpeg($new_image, $destination);
}
?>