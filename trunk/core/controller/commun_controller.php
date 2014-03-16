<?php
require_once  ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/CommunServiceImpl.php");


if(!isset($_SESSION['USER'])){
	header("location:/html/html/login/index.php");
}else{
	
	$communService = new CommunServiceImpl();
	
	$utilisateur = unserialize($_SESSION['USER']);
	$_SESSION['TYPE_UTILISATEUR'] = $communService->getTypeUtilisateur($utilisateur);
	if(!isset($_SESSION['ETABLISSEMENT_ID'])){
		$_SESSION['ETABLISSEMENT_ID'] = $communService->getFirstEtablissement($utilisateur);
	}
	$etablissement = $communService->getEtablissement($_SESSION['ETABLISSEMENT_ID']);
	$listeEtablissement = $communService->getEtablissementFromUser($utilisateur->idUser);
} 