<?php

include($_SERVER['DOCUMENT_ROOT']."/myschool/core/include.php");

function validateLogin($username, $userId){
	$utilisaterDao = new UtilisateurDao();
	$utilisateur = $utilisaterDao->findUtilisateurByUsername($username);
	if($utilisateur == null || ($utilisateur != null && $utilisateur->idUser == $userId)){
		return true;
	}else{
		return false;
	}

}

function updateUtilisateur($utilisateur){
	$utilisaterDao = new UtilisateurDao();
	return $utilisaterDao->updateUtilisateur($utilisateur);
}

function updateEtablissement($etablissement){
	$etablissementDao = new EtablissementDao();
	return $etablissementDao->updateEtablissement($etablissement);
}

function getNiveauxByEtablissement($idEtablissement){
	$niveauDao = new NiveauDao();
	return $niveauDao->findNiveauxByEtablissement($idEtablissement);
}

function getNiveauById($idNiveau){
	$niveauDao = new NiveauDao();
	return $niveauDao->findNiveau($idNiveau);
}


function validateNiveau($nom, $niveauId,$etablissementId){
	$niveauDao = new NiveauDao();
	$niveau = $niveauDao->findNiveauByNomAndEtablissement($nom, $etablissementId);
	if($niveau == null || ($niveau != null && $niveau->idNiveau == $niveauId)){
		return true;
	}else{
		return false;
	}

}

function saveOrUpdateNiveau($niveau){
	$niveauDao = new NiveauDao();
	if($niveau->idNiveau == null){
		return $niveauDao->saveNiveau($niveau);
	}else{
		return $niveauDao->updateNiveau($niveau);
	}
}
function deleteNiveau($niveau){
	$niveauDao = new NiveauDao();
	return $niveauDao->deleteNiveau($niveau);
}