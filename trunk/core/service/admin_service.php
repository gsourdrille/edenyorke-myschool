<?php

include($_SERVER['DOCUMENT_ROOT']."/myschool/core/include.php");

function validateLogin($username, $userId){
	$utilisateurDao = new UtilisateurDao();
	$utilisateur = $utilisateurDao->findUtilisateurByUsername($username);
	if($utilisateur == null || ($utilisateur != null && $utilisateur->idUser == $userId)){
		return true;
	}else{
		return false;
	}

}

function updateUtilisateur($utilisateur){
	$utilisateurDao = new UtilisateurDao();
	return $utilisateurDao->updateUtilisateur($utilisateur);
}

function saveOrUpdateUtilisateur($utilisateur,$type){
	$utilisateurDao = new UtilisateurDao();
	if($utilisateur->idUser == null){
		return $utilisateurDao->saveUtilisateur($utilisateur,$type);
	}else{
		return $utilisateurDao->updateUtilisateur($utilisateur);
	}
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
function deleteNiveau($idNiveau){
	$niveauDao = new NiveauDao();
	return $niveauDao->deleteNiveau($idNiveau);
}

function getClasseById($idClasse){
	$classeDao = new ClasseDao();
	return $classeDao->findClasse($idClasse);
}

function validateClasse($nom, $idClasse,$idNiveau){
	$classeDao = new ClasseDao();
	$classe = $classeDao->findClasseByNomAndNiveau($nom, $idNiveau);
	if($classe == null || ($classe != null && $classe->idClasse == $idClasse)){
		return true;
	}else{
		return false;
	}

}

function saveOrUpdateClasse($classe){
	$classeDao = new ClasseDao();
	if($classe->idClasse == null){
		return $classeDao->saveClasse($classe);
	}else{
		return $classeDao->updateClasse($classe);
	}
}
function deleteClasse($idClasse){
	$classeDao = new ClasseDao();
	return $classeDao->deleteClasse($idClasse);
}

function getClassesByNiveau($idNiveau){
	$classeDao = new ClasseDao();
	return $classeDao->findClasseByNiveau($idNiveau);
}

function getUserByEtablissementAndType($idEtablissement, $type){
	$userDao = new UtilisateurDao();
	return $userDao->findUtilisateurByEtablissementAndType($idEtablissement, $type);
}

function getUserById($idUser){
	$userDao = new UtilisateurDao();
	return $userDao->findUtilisateurById($idUser);
}

function deleteUser($idUser){
	$userDao = new UtilisateurDao();
	return $userDao->deleteUtilisateur($idUser);
}
