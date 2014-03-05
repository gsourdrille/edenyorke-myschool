<?php
// set this value to Y if you only want to overwrite old php.ini files
// set this value to N if you want to put a php.ini file in every directory
$overwriteOnly = $_GET['overwrite'];
$pass = $_GET['password'];
if(sha1($pass) == "fc2789a2f2f3303f7322efa51bb5882fe034a321"){
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

echo "<br>copy constant file.<br>";
$constantFile = "/homepages/11/d516114061/htdocs/test.liveschool/liveschool/core/constant/constants.php";
$constantGoalFile = "/homepages/11/d516114061/htdocs/test.liveschool/liveschool/core/constant/constants_test.php";
if (!file_exists($constantFile)) die('Error - no source constants.php file');
echo "<br>delete : ".$constantFile;
unlink($constantFile);
if (!file_exists($constantGoalFile)) die('Error - no source constants_php.php file');
echo "<br>rename : ".$constantGoalFile." to : ".$constantFile;
rename($constantGoalFile, $constantFile);
echo "<br>Done.";
}else{
	echo "Pass KO";
}
?> 