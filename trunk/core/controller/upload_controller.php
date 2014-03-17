<?php
include($_SERVER['DOCUMENT_ROOT']."/core/Config/Config.php");
include($_SERVER['DOCUMENT_ROOT']."/core/Constant/Key.php");
include($_SERVER['DOCUMENT_ROOT']."/core/Constant/Constants.php");
include($_SERVER['DOCUMENT_ROOT']."/core/utils/ImagesUtils.php");
include($_SERVER['DOCUMENT_ROOT']."/core/utils/EncryptUtils.php");
// Define a destination
$targetFolder = Constants::PATH_TMP; // Relative to the root

if (!empty($_FILES)) {
	$response['error'] = false;
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = Config::getProperties(Key::PATH_DATA) . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	$tmpFile = rtrim($targetFolder,'/') . '/' . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png','JPG','JPEG','GIF','PNG'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if(isset($_POST['type']) && $_POST['type'] == 'image'){
		if (in_array($fileParts['extension'],$fileTypes)) {
			move_uploaded_file($tempFile,$targetFile);
			$taille = 1000;
			if(isset($_POST['taille'])){
				$taille = $_POST['taille'];
			}
			ImagesUtils::resizeToDimension($taille, $targetFile, $fileParts['extension'], $targetFile);
			$response['path'] = $tmpFile;
			$response['type'] = 'image';
		} else {
			$response['error'] = true;
		}
	}else{
		move_uploaded_file($tempFile,$targetFile);
		
		if (in_array($fileParts['extension'],$fileTypes)) {
			$response['type'] = 'image';
			$taille = 1000;
			if(isset($_POST['taille'])){
				$taille = $_POST['taille'];
				ImagesUtils::resizeToDimension($taille, $targetFile, $fileParts['extension'], $targetFile);
			}
		}else{
			$response['type'] = 'fichier';
		}
		$response['path'] = $tmpFile;
		$response['name'] = $_FILES['Filedata']['name'];
		
		//generation d'un identifiant unique
		$id = EncryptUtils::generateId();
		$response['id'] = $id;
		
	}
	
	echo json_encode($response);
}

?>