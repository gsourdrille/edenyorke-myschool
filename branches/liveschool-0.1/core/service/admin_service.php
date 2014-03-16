<?php

include_once($_SERVER['DOCUMENT_ROOT']."/core/include.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/service/encrypt_service.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/service/mail_service.php");

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

function saveOrUpdateUtilisateur($utilisateur,$type, $etablissementId){
	$utilisateurDao = new UtilisateurDao();
	if($utilisateur->idUser == null){
		$utlisateur = $utilisateurDao->saveUtilisateur($utilisateur,$type);
		$utilisateurDao->addEtablissementToUtilisateur($etablissementId, $utilisateur->idUser);
		return $utlisateur;
	}else{
		return $utilisateurDao->updateUtilisateur($utilisateur);
	}
}

function updateEtablissement($etablissement){
	$etablissementDao = new EtablissementDao();
	return $etablissementDao->updateEtablissement($etablissement);
}

function setImagePrincipaleToEtablissement($etablissement, $imageName){
	FileUtils::deleteEtablissementImagePrincipale($etablissement);
	$etablissementDao = new EtablissementDao();
	return $etablissementDao->setImagePrincipaleToEtablissement($etablissement->idEtablissement, $imageName);
}

function setImageFondToEtablissement($etablissement, $imageName){
	FileUtils::deleteEtablissementImageFond($etablissement);
	$etablissementDao = new EtablissementDao();
	return $etablissementDao->setImageFondToEtablissement($etablissement->idEtablissement, $imageName);
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

function getClassesByEtablissement($idEtablissement){
	$classeDao = new ClasseDao();
	return $classeDao->findClasseByEtablissement($idEtablissement);
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

function deleteEtablissementToUtilisateur($idEtablissement,$idUser){
	$userDao = new UtilisateurDao();
	$userDao->deleteEtablissementToUtilisateur($idEtablissement,$idUser);
	$classeDao = new ClasseDao();
	$classeDao->deleteClasseToUtilisateurAndEtablissement($idEtablissement,$idUser);
	/*
	//Supression des posts associés à l'utilisateur
	$postDao = new PostDao();
	$listePost =  $postDao->getPostFromUtilisateur($idUser);
	if($listePost != null && $listePost->count()>0){
		foreach ($listePost as $post){
			$postDao->deletePost($post->idPost);
			FileUtils::deletePostDir($idPost);
		}
	}
	
	//Suppression des commentaires
	$commentaireDao = new CommentaireDao();
	$commentaireDao->deleteCommentaireToUtilisateur($idUser);
	*/
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

function getAllNiveauxForEtablissement($idEtablissement){
	return getNiveauxByEtablissement($idEtablissement);
}

function getClassesByUser($idUser){
	$classeDao = new ClasseDao();
	return $classeDao ->getClassesByUtlisateur($idUser);
	
}

function addClassesToUser($idUser, $listeIdClasses){
	$classeDao = new ClasseDao();
	$classeDao ->addClassesToUser($idUser, $listeIdClasses);

}

function addClasseToUser($idUser, $idClasse){
	$classeDao = new ClasseDao();
	$classeDao ->addClasseToUser($idUser, $idClasse);

}

function addEtablissementToUser($idUser, $idEtablissement){
	$etablissementDao = new EtablissementDao();
	$listeUtilisateur = $etablissementDao->getEtablissementsFromUser($idUser);
	$etablissementPresent = false;
	foreach ($listeUtilisateur as $etablissement){
		if($etablissement->idEtablissement == $idEtablissement){
			$etablissementPresent = true;
		}
	}
	$utilisateurDao = new UtilisateurDao();
	if(!$etablissementPresent){
		$utilisateurDao ->addEtablissementToUtilisateur($idEtablissement, $idUser);
	}
	

}

function deleteClassesToUser($idUser, $listeIdClasse){
	$classeDao = new ClasseDao();
	$classeDao ->deleteClassesToUser($idUser, $listeIdClasse);

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
	$utilisateurDao->addEtablissementToUtilisateur($etablissementId, $user->idUser);
	
	//Association de la classe
	$classeDao = new ClasseDao();
	$classeDao -> addClasseToUser($user->idUser, $classe->idClasse);
	
	
	envoiMailConfirmationInscription($user);
	
	return $user;
	
}

function validToken($token){
	$utilisateurDao = new UtilisateurDao();
	return $utilisateurDao->activerUtilisateur($token);
}


function envoiMailConfirmationInscription($user){
	//Ajout d'un jeton pour la validation de l'inscription
	$utilisateurDao = new UtilisateurDao();
	$token = generateToken();
	$utilisateurDao->ajouterToken($user->idUser, $token) ;
	//envoi du mail
	envoiMailInscription($user,$token);
}

function sendNewPassword($login){
	$utilisateurDao = new UtilisateurDao();
	$utilisateur = $utilisateurDao->findUtilisateurByUsername($login);
	if($utilisateur != null){
		$newPassowrd = EncryptUtils::generatePassword();
		$utilisateur->mdp =sha1($newPassowrd);
		$utilisateurDao->updateUtilisateur($utilisateur);
		//envoi du mail
		envoiMailConfirmationEnvoiPassword($utilisateur,$newPassowrd);
		return true;
	}
	return false;
}
