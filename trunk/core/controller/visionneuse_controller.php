<?php
require ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/PostServiceImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");

$logger = new Logger(Config::getProperties(Key::LOGGER_LOCATION));

try{
	$postService = new PostServiceImpl();
	$idPost = $_GET['idPost'];
	$listeImages = $postService->getImagesFromPost($idPost);
}catch (Exception $e){
	$logger->log('erreur', 'liveschool_error', $e->getTraceAsString() , Logger::GRAN_MONTH);
}			


