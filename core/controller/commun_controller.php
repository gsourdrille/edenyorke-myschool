<?php
include_once  ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/CommunServiceImpl.php");
include_once  ($_SERVER['DOCUMENT_ROOT']."/core/controller/exception_controller.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");

Logger::configure($_SERVER['DOCUMENT_ROOT']."/conf/log4php.xml");
$logger = Logger::getLogger("LiveSchool");

if(!isset($_SESSION['USER'])){
	header("location:/login");
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
		$logger->error($e->getTraceAsString(), $e);
		header("location:/erreur/erreur500");
	}
} 

