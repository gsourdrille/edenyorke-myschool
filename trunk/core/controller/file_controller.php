<?php
include_once($_SERVER['DOCUMENT_ROOT']."/core/constant/constants.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/utils/file_utils.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/service/post_service.php");
if(isset($_GET['pj']) && isset($_GET['post'])){
	$pj = getPj($_GET['pj'], $_GET['post']);
	if($pj != null){
		$filename = Constants::PATH_DATA.FileUtils::getPostFile($pj->idPost,$pj->path);
		header('Pragma: public');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Cache-Control: private', false); // required for certain browsers
		header('Content-Type: '.$pj->contentType);
		
		header('Content-Disposition: attachment; filename="'. basename($filename) . '";');
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: ' . filesize($filename));
		
		readfile($filename);
	}
	
	
}



exit;