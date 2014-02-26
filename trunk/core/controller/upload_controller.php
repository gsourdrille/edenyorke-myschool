<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/
include_once($_SERVER['DOCUMENT_ROOT']."/core/constant/constants.php");
// Define a destination
$targetFolder = Constants::PATH_TMP; // Relative to the root


if (!empty($_FILES)) {
	$response['error'] = false;
	
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = Constants::PATH_DATA . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	$tmpFile = rtrim($targetFolder,'/') . '/' . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png','JPG','JPEG','GIF','PNG'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if(isset($_POST['type']) && $_POST['type'] == 'image'){
		if (in_array($fileParts['extension'],$fileTypes)) {
			move_uploaded_file($tempFile,$targetFile);
			$response['path'] = $tmpFile;
			$response['type'] = 'image';
		} else {
			$response['error'] = true;
		}
	}else{
		move_uploaded_file($tempFile,$targetFile);
		if (in_array($fileParts['extension'],$fileTypes)) {
			$response['type'] = 'image';
		}else{
			$response['type'] = 'fichier';
		}
		$response['path'] = $tmpFile;
	}
	
	echo json_encode($response);
}

?>