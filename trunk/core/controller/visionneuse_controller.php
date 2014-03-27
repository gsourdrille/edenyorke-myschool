<?php
require ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/PostServiceImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");

Logger::configure($_SERVER['DOCUMENT_ROOT']."/conf/log4php.xml");
$logger = Logger::getLogger("LiveSchool");

try{
	$postService = new PostServiceImpl();
	$idPost = $_GET['idPost'];
	$listeImages = $postService->getImagesFromPost($idPost);
}catch (Exception $e){
	$logger->error($e->getTraceAsString() , $e);
}			


