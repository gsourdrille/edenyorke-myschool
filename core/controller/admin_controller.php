<?php

require ('../service/tableau_service.php');
require('../logs/Logger.class.php');

// Creation d'un objet Logger
$logger = new Logger(Constants::LOGGER_LOCATION);
session_start();

if(!isset($_SESSION['USER'])){
	session_destroy();
	header("location:/myschool/html/html/login/index.php");
}else{
	$utilisateur = unserialize($_SESSION['USER']);
	$listeTypeUtilisateur = getTypeUtilisateur($utilisateur);
	if($listeTypeUtilisateur!= null && $listeTypeUtilisateur->count()>0){
		$_SESSION['TYPE_UTILISATEUR'] = $listeTypeUtilisateur[0];
	}
	$listeEtablissement = getListeEtabliseement($utilisateur);
	if($listeEtablissement!= null && $listeEtablissement->count()>0){
		$etablissement = getEtablissement($listeEtablissement[0]);
		if($etablissement != null){
			$_SESSION['ETABLISSEMENT_ID'] = $etablissement->idEtablissement;
		}
	}
	
	if(isset($_GET['action'])){
		if($_GET['action']=='infos'){
			require ("../../html/html/admin/admin_infos.php");
		}
	}else{
		require ("../../html/html/admin/index.php");
	}
}