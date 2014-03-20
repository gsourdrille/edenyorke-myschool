<?php

// include image processing code
include_once($_SERVER['DOCUMENT_ROOT']."/core/utils/thumbnail/image.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/config/Config.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/constant/Key.php");
###############################################################
# Thumbnail Image Generator 1.3
###############################################################
# Visit http://www.zubrag.com/scripts/ for updates
############################################################### 

// REQUIREMENTS:
// PHP 4.0.6 and GD 2.0.1 or later
// May not work with GIFs if GD2 library installed on your server 
// does not support GIF functions in full

// Parameters:
// src - path to source image
// dest - path to thumb (where to save it)
// x - max width
// y - max height
// q - quality (applicable only to JPG, 1 to 100, 100 - best)
// t - thumb type. "-1" - same as source, 1 = GIF, 2 = JPG, 3 = PNG
// f - save to file (1) or output to browser (0).

// Sample usage: 
// 1. save thumb on server
// http://www.zubrag.com/thumb.php?src=test.jpg&dest=thumb.jpg&x=100&y=50
// 2. output thumb to browser
// http://www.zubrag.com/thumb.php?src=test.jpg&x=50&y=50&f=0


// Below are default values (if parameter is not passed)

// save to file (true) or output to browser (false)
$save_to_file = true;

// Quality for JPEG and PNG.
// 0 (worst quality, smaller file) to 100 (best quality, bigger file)
// Note: PNG quality is only supported starting PHP 5.1.2
$image_quality = 100;

// resulting image type (1 = GIF, 2 = JPG, 3 = PNG)
// enter code of the image type if you want override it
// or set it to -1 to determine automatically
$image_type = -1;

// maximum thumb side size
$max_x = 100;
$max_y = 100;

// cut image before resizing. Set to 0 to skip this.
$cut_x = 0;
$cut_y = 0;

// Folder where source images are stored (thumbnails will be generated from these images).
// MUST end with slash.
$images_folder = Config::getProperties(Key::PATH_DATA);

// Folder to save thumbnails, full path from the root folder, MUST end with slash.
// Only needed if you save generated thumbnails on the server.
// Sample for windows:     c:/wwwroot/thumbs/
// Sample for unix/linux:  /home/site.com/htdocs/thumbs/
$thumbs_folder = '/www/thumbs/';


///////////////////////////////////////////////////
/////////////// DO NOT EDIT BELOW
///////////////////////////////////////////////////

$to_name = '';

if (isset($_REQUEST['f'])) {
  $save_to_file = intval($_REQUEST['f']) == 1;
}

if (isset($_REQUEST['src'])) {
  $from_name = urldecode($_REQUEST['src']);
}
else {
  die("Source file name must be specified.");
}

if (isset($_REQUEST['dest'])) {
  $to_name = urldecode($_REQUEST['dest']);
}
else if ($save_to_file) {
  die("Thumbnail file name must be specified.");
}

if (isset($_REQUEST['q'])) {
  $image_quality = intval($_REQUEST['q']);
}

if (isset($_REQUEST['t'])) {
  $image_type = intval($_REQUEST['t']);
}

if (isset($_REQUEST['x'])) {
  $max_x = intval($_REQUEST['x']);
}

if (isset($_REQUEST['y'])) {
  $max_y = intval($_REQUEST['y']);
}

if(isset($_REQUEST['resize'])){
	$resize = true;
}else{
	$resize = false;
}

// if (!file_exists($images_folder)) die('Images folder does not exist (update $images_folder in the script)');
// if ($save_to_file && !file_exists($thumbs_folder)) die('Thumbnails folder does not exist (update $thumbs_folder in the script)');

// Allocate all necessary memory for the image.
// Special thanks to Alecos for providing the code.
ini_set('memory_limit', '-1');

$img = new Zubrag_image;

// initialize
$img->max_x        = $max_x;
$img->max_y        = $max_y;
$img->cut_x        = $cut_x;
$img->cut_y        = $cut_y;
$img->quality      = $image_quality;
$img->save_to_file = $save_to_file;
$img->image_type   = $image_type;
$img->resize       = $resize;

// generate thumbnail
$img->GenerateThumbFile($images_folder . $from_name, $thumbs_folder . $to_name);

?>
