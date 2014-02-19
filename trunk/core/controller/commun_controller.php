<?php
require_once  ($_SERVER['DOCUMENT_ROOT']."/core/service/commun_service.php");


if(!isset($_SESSION['USER'])){
	header("location:/html/html/login/index.php");
}else{

	$utilisateur = unserialize($_SESSION['USER']);
	$_SESSION['TYPE_UTILISATEUR'] = getTypeUtilisateur($utilisateur);
	$etablissement = getEtablissement($utilisateur->etablissement);
	if($etablissement != null){
		$_SESSION['ETABLISSEMENT_ID'] = $etablissement->idEtablissement;
	}
} 