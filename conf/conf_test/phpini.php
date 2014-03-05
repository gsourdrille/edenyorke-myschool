<?php
// set this value to Y if you only want to overwrite old php.ini files
// set this value to N if you want to put a php.ini file in every directory
$overwriteOnly = $_GET['overwrite'];

if ($overwriteOnly == "Y") echo "Operating in Overwrite Only Mode<br><br>";
$path = "/homepages/11/d516114061/htdocs/test.liveschool/liveschool";
$source = "/homepages/11/d516114061/htdocs/test.liveschool/liveschool/conf/conf_test/php.ini";
if (!file_exists($source)) die('Error - no source php.ini file');
function search($dir) {
global $source;
global $overwriteOnly;
$dh = opendir($dir);
while (($filename = readdir($dh)) !== false) {
if ( $filename !== '.' AND $filename !== '..' AND $filename !== 'cgi-bin' AND is_dir("$dir/$filename") ) {
$path = $dir."/".$filename;
$target = $path . "/php.ini";
if (!file_exists($target) AND $overwriteOnly == "Y") {
echo "$path <b>skipped - no php.ini file</b><br>";
} else {
echo "$target <br>";
if (!copy($source,$target)) echo "<b>Write failed for $target </b><br>";
if (file_exists($target)) chmod($target,0600);
}
search($path);
}
}
closedir($dh);
}
search($path);
echo "<br>Done.";
?> 