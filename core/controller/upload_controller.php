<?php
include_once($_SERVER['DOCUMENT_ROOT']."/core/config/Config.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/constant/Key.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/constant/Constants.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/utils/ImagesUtils.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/utils/EncryptUtils.php");

include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");

Logger::configure($_SERVER['DOCUMENT_ROOT']."/conf/log4php.xml");
$logger = Logger::getLogger("LiveSchool");

try{
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
				$size = getimagesize($tempFile);
				if($size[0] > 3500 || $size[1] > 3500){
					$response['error'] = true;
					$response['error_message'] = "L'image ".$_FILES['Filedata']['name']." est trop grande";
				}else{
					move_uploaded_file($tempFile,$targetFile);
					$taille = 1000;
					if(isset($_POST['taille'])){
						$taille = $_POST['taille'];
					}
					ImagesUtils::resizeToDimension($taille, $targetFile, $fileParts['extension'], $targetFile);
					$response['path'] = $tmpFile;
					$response['type'] = 'image';
				}
			} else {
				$response['error'] = true;
			}
		}else{
			move_uploaded_file($tempFile,$targetFile);
			
			if (in_array($fileParts['extension'],$fileTypes)) {
				$size = getimagesize($tempFile);
				if($size[0] > 3500 || $size[1] > 3500){
					$response['error'] = true;
					$response['error_message'] = "L'image ".$_FILES['Filedata']['name']." est trop grande";
				}else{
					$response['type'] = 'image';
					$taille = 1000;
					if(isset($_POST['taille'])){
						$taille = $_POST['taille'];
						ImagesUtils::resizeToDimension($taille, $targetFile, $fileParts['extension'], $targetFile);
					}
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
}catch (Exception $e){
	$logger->error($e->getTraceAsString() , $e);
}
?>