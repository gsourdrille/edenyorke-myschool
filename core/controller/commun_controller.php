<?php
require_once  ($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/commun_service.php");

if(!isset($_SESSION['USER'])){
	header("location:/myschool/html/html/login/index.php");
}else{

	$utilisateur = unserialize($_SESSION['USER']);
	$listeTypeUtilisateur = getTypeUtilisateur($utilisateur);
	if($listeTypeUtilisateur!= null && $listeTypeUtilisateur->count()>0){
		$_SESSION['TYPE_UTILISATEUR'] = $listeTypeUtilisateur[0];
	}
	$etablissement = getEtablissement($utilisateur->etablissement);
	if($etablissement != null){
		$_SESSION['ETABLISSEMENT_ID'] = $etablissement->idEtablissement;
	}
} 