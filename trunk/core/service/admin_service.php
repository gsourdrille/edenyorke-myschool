<?php

include($_SERVER['DOCUMENT_ROOT']."/myschool/core/include.php");
include($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/encrypt_service.php");
include($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/mail_service.php");

function validateLogin($username, $userId){
	$utilisateurDao = new UtilisateurDao();
	$utilisateur = $utilisateurDao->findUtilisateurByUsername($username);
	if($utilisateur == null || ( $userId != null && ($utilisateur != null && $utilisateur->idUser == $userId))){
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

function setImageToEtablissement($etablissement, $imageName){
	FileUtils::deleteEtablissementFile($etablissement);
	$etablissementDao = new EtablissementDao();
	return $etablissementDao->setImageToEtablissement($etablissement->idEtablissement, $imageName);
}

function setImageToUtilisateur($utilisateur, $imageName){
	FileUtils::deleteUtilisateurFile($utilisateur);
	$utilisateurDao = new UtilisateurDao();
	return $utilisateurDao->setImageToUtilisateur($utilisateur->idUser, $imageName);
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
		$classe->codeEleve = generateUniqueCode();
		$classe->codeEnseignant = generateUniqueCode();
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

function getAllClassesForEtablissement($idEtablissement){
	$listeClassesAndNiveaux = null;
	
	$listNiveaux = new ArrayObject();
	$listeNiveaux = getNiveauxByEtablissement($idEtablissement);
	if($listeNiveaux->count() > 0){
		foreach ($listeNiveaux as $niveau){
			$listeClasse = new ArrayObject();
			$listeClasse = getClassesByNiveau($niveau->idNiveau);
			if($listeClasse->count() > 0){
				$listeClassesAndNiveaux[$niveau->nom] = $listeClasse;
			}
		}
	}
	return $listeClassesAndNiveaux;
}

function getClassesByUser($idUser){
	$classeDao = new ClasseDao();
	return $classeDao ->getClassesByUtlisateur($idUser);
	
}

function addClassesToUser($idUser, $listeIdClasses){
	$classeDao = new ClasseDao();
	$classeDao ->addClassesToUser($idUser, $listeIdClasses);

}

function getClasseFromCode($code){
	$classeDao = new ClasseDao();
	return $classeDao->findClasseByCode($code);
	
}

function saveUtilisateur($user, $classe, $code){
	
	//Gestion de l'etablissement
	$niveauDao = new NiveauDao();
	$niveau = $niveauDao->findNiveau($classe->idNiveau);
	$etablissementId = $niveau->idEtablissement;
	$user->etablissement = $etablissementId;
	
	//Gestion du type
	$typeUtilisateur = null;
	if($code == $classe->codeEleve){
		$typeUtilisateur = Type_Utilisateur::ELEVE;
	}else if($code == $classe->codeEnseignant){
		$typeUtilisateur = Type_Utilisateur::ENSEIGNANT;
	}else{
		return null;
	}
	
	//Enregistrement de l'utilisateur
	$utilisateurDao = new UtilisateurDao();
	$user = $utilisateurDao->saveUtilisateur($user, $typeUtilisateur);
	
	//Ajout d'un jeton pour la validation de l'inscription
	$token = generateToken();
	$utilisateurDao->ajouterToken($user->idUser, $token) ;
	
	//Association de la classe
	$classeDao = new ClasseDao();
	$classeDao -> addClasseToUser($user->idUser, $classe->idClasse);
	
	//envoi du mail
	envoiMailInscription($user->idUser,$token);
	
	return $user;
	
}

function validToken($token){
	$utilisateurDao = new UtilisateurDao();
	return $utilisateurDao->activerUtilisateur($token);
}