<?php
@session_start();
include_once ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/AdminServiceImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/controller/commun_controller.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");

$logger = new Logger(Config::getProperties(Key::LOGGER_LOCATION));

try{
	$adminService = new AdminServiceImpl();
	//Maj de la liste des classes
	$listeClasse = $adminService->getClassesByUser($utilisateur->idUser);
}catch (Exception $e){
	$logger->log('erreur', 'liveschool_error', $e->getTraceAsString() , Logger::GRAN_MONTH);
	header("location:/erreur/erreur500");
}