<? 

// Original image
$filename = 'uploads/asd.jpg';
 $newname = '';
// Get dimensions of the original image
list($current_width, $current_height) = getimagesize($filename);
 
// The x and y coordinates on the original image where we
// will begin cropping the image
$left = rand(100,$current_width);
$top = rand(100,$current_height);
 
// This will be the final size of the image (e.g. how many pixels
// left and down we will be going)
$crop_width = 350;
$crop_height = 260;
 
// Resample the image
$canvas = imagecreatetruecolor($crop_width, $crop_height);
$current_image = imagecreatefromjpeg($filename);
imagecopy($canvas, $current_image, 0, 0, $left, $top, $current_width, $current_height);
imagejpeg($canvas, $newname, 100);

?>