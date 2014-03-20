<?php
include_once($_SERVER['DOCUMENT_ROOT']."/core/config/Config.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/constant/Key.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/utils/FileUtils.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/service/impl/PostServiceImpl.php");

$postService = new PostServiceImpl();

if(isset($_GET['pj']) && isset($_GET['post'])){
	$pj = $postService->getPj($_GET['pj'], $_GET['post']);
	if($pj != null){
		$filename = Config::getProperties(Key::PATH_DATA).FileUtils::getPostFile($pj->idPost,$pj->path);
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