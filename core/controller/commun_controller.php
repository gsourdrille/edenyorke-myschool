<?php
include_once  ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/CommunServiceImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");

$logger = new Logger(Config::getProperties(Key::LOGGER_LOCATION));

if(!isset($_SESSION['USER'])){
	header("location:/html/html/login/index.php");
}else{
	try{
		$communService = new CommunServiceImpl();
		$utilisateur = unserialize($_SESSION['USER']);
		$_SESSION['TYPE_UTILISATEUR'] = $communService->getTypeUtilisateur($utilisateur);
		if(!isset($_SESSION['ETABLISSEMENT_ID'])){
			$_SESSION['ETABLISSEMENT_ID'] = $communService->getFirstEtablissement($utilisateur);
		}
		$etablissement = $communService->getEtablissement($_SESSION['ETABLISSEMENT_ID']);
		$listeEtablissement = $communService->getEtablissementFromUser($utilisateur->idUser);
	}catch (Exception $e){
		$logger->log('erreur', 'liveschool_error', $e->getTraceAsString() , Logger::GRAN_MONTH);
		header("location:/core/controller/erreur_controller.php");
	}
} 