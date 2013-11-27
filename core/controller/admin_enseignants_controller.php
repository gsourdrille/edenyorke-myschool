<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/admin_service.php");
include($_SERVER['DOCUMENT_ROOT']."/myschool/core/controller/commun_controller.php");


//Recuperation des enseignants lies a l'etablissement
$listeEnseignants = getUserByEtablissementAndType($_SESSION['ETABLISSEMENT_ID'],Type_Utilisateur::ENSEIGNANT);
if(isset($_GET['action'])){
	$action = $_GET['action'];
	if($action == 'showEnseignant'){
		$enseignant = getUserById($_GET['idUser']);
		$_SESSION['ENSEIGNANT_SELECTED'] = $enseignant->idUser;
		$showEnseignant = true;
	}
}


 if(isset($_POST['showAddEnseignant'])){
 	$showEnseignant = true;
 }else if(isset($_POST['deleteEnseignant'])){
	$idEnseignant = $_SESSION['ENSEIGNANT_SELECTED'];
	deleteUser($idEnseignant);
	$showEnseignant = false;
	$listeEnseignants = getUserByEtablissementAndType($_SESSION['ETABLISSEMENT_ID'],Type_Utilisateur::ENSEIGNANT);
	$_SESSION['ENSEIGNANT_SELECTED'] = null;
}

require ($_SERVER['DOCUMENT_ROOT']."/myschool/html/html/admin/admin_enseignants/index.php");