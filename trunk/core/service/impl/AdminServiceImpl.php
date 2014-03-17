<?php

include_once($_SERVER['DOCUMENT_ROOT']."/core/service/impl/EncryptServiceImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/service/impl/MailServiceImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/impl/UtilisateurDaoImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/impl/EtablissementDaoImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/impl/NiveauDaoImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/impl/ClasseDaoImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/service/AdminService.php");

class AdminServiceImpl implements AdminService{
	
	var $utilisateurDao;
	var $etablissementDao;
	var $niveauDao;
	var $classeDao;
	
	function __construct() {
		$this->utilisateurDao = new UtilisateurDaoImpl();
		$this->etablissementDao = new EtablissementDaoImpl();
		$this->niveauDao = new NiveauDaoImpl();
		$this->classeDao = new ClasseDaoImpl();
	}

	function validateLogin($username, $userId){
		$utilisateur = $this->utilisateurDao->findUtilisateurByUsername($username);
		if($utilisateur == null || ( $userId != null && ($utilisateur != null && $utilisateur->idUser == $userId))){
			return true;
		}else{
			return false;
		}
	}
	
	function updateUtilisateur($utilisateur){
		return $this->utilisateurDao->updateUtilisateur($utilisateur);
	}
	
	function saveOrUpdateUtilisateur($utilisateur,$type, $etablissementId){
		if($utilisateur->idUser == null){
			$utlisateur = $this->utilisateurDao->saveUtilisateur($utilisateur,$type);
			$this->utilisateurDao->addEtablissementToUtilisateur($etablissementId, $utilisateur->idUser);
			return $utlisateur;
		}else{
			return $this->utilisateurDao->updateUtilisateur($utilisateur);
		}
	}
	
	function updateEtablissement($etablissement){
		return $this->etablissementDao->updateEtablissement($etablissement);
	}
	
	function setImagePrincipaleToEtablissement($etablissement, $imageName){
		FileUtils::deleteEtablissementImagePrincipale($etablissement);
		return $this->etablissementDao->setImagePrincipaleToEtablissement($etablissement->idEtablissement, $imageName);
	}
	
	function setImageFondToEtablissement($etablissement, $imageName){
		FileUtils::deleteEtablissementImageFond($etablissement);
		return $this->etablissementDao->setImageFondToEtablissement($etablissement->idEtablissement, $imageName);
	}
	
	function setImageToUtilisateur($utilisateur, $imageName){
		FileUtils::deleteUtilisateurFile($utilisateur);
		return $this->utilisateurDao->setImageToUtilisateur($utilisateur->idUser, $imageName);
	}
	
	
	function getNiveauxByEtablissement($idEtablissement){
		return $this->niveauDao->findNiveauxByEtablissement($idEtablissement);
	}
	
	function getClassesByEtablissement($idEtablissement){
		return $this->classeDao->findClasseByEtablissement($idEtablissement);
	}
	
	
	function getNiveauById($idNiveau){
		return $this->niveauDao->findNiveau($idNiveau);
	}
	
	
	function validateNiveau($nom, $niveauId,$etablissementId){
		$niveau = $this->niveauDao->findNiveauByNomAndEtablissement($nom, $etablissementId);
		if($niveau == null || ($niveau != null && $niveau->idNiveau == $niveauId)){
			return true;
		}else{
			return false;
		}
	
	}
	
	function saveOrUpdateNiveau($niveau){
		if($niveau->idNiveau == null){
			return $this->niveauDao->saveNiveau($niveau);
		}else{
			return $this->niveauDao->updateNiveau($niveau);
		}
	}
	function deleteNiveau($idNiveau){
		return $this->niveauDao->deleteNiveau($idNiveau);
	}
	
	function getClasseById($idClasse){
		return $this->classeDao->findClasse($idClasse);
	}
	
	function validateClasse($nom, $idClasse,$idNiveau){
		$classe = $this->classeDao->findClasseByNomAndNiveau($nom, $idNiveau);
		if($classe == null || ($classe != null && $classe->idClasse == $idClasse)){
			return true;
		}else{
			return false;
		}
	
	}
	
	function saveOrUpdateClasse($classe){
		if($classe->idClasse == null){
			$classe->codeEleve = generateUniqueCode();
			$classe->codeEnseignant = generateUniqueCode();
			return $this->classeDao->saveClasse($classe);
		}else{
			return $this->classeDao->updateClasse($classe);
		}
	}
	function deleteClasse($idClasse){
		return $this->classeDao->deleteClasse($idClasse);
	}
	
	function getClassesByNiveau($idNiveau){
		return $this->classeDao->findClasseByNiveau($idNiveau);
	}
	
	function getUserByEtablissementAndType($idEtablissement, $type){
		return $this->utilisateurDao->findUtilisateurByEtablissementAndType($idEtablissement, $type);
	}
	
	function getUserById($idUser){
		return $this->utilisateurDao->findUtilisateurById($idUser);
	}
	
	function deleteUser($idUser){
		return $this->utilisateurDao->deleteUtilisateur($idUser);
	}
	
	function deleteEtablissementToUtilisateur($idEtablissement,$idUser){
		$this->utilisateurDao->deleteEtablissementToUtilisateur($idEtablissement,$idUser);
		$this->classeDao->deleteClasseToUtilisateurAndEtablissement($idEtablissement,$idUser);
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
		$listeNiveaux = $this->getNiveauxByEtablissement($idEtablissement);
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
		return $this->classeDao->getClassesByUtlisateur($idUser);
		
	}
	
	function addClassesToUser($idUser, $listeIdClasses){
		$this->classeDao->addClassesToUser($idUser, $listeIdClasses);
	
	}
	
	function addClasseToUser($idUser, $idClasse){
		$this->classeDao->addClasseToUser($idUser, $idClasse);
	
	}
	
	function addEtablissementToUser($idUser, $idEtablissement){
		$listeUtilisateur = $this->etablissementDao->getEtablissementsFromUser($idUser);
		$etablissementPresent = false;
		foreach ($listeUtilisateur as $etablissement){
			if($etablissement->idEtablissement == $idEtablissement){
				$etablissementPresent = true;
			}
		}
		if(!$etablissementPresent){
			$this->utilisateurDao->addEtablissementToUtilisateur($idEtablissement, $idUser);
		}
		
	
	}
	
	function deleteClassesToUser($idUser, $listeIdClasse){
		$this->classeDao->deleteClassesToUser($idUser, $listeIdClasse);
	
	}
	
	function getClasseFromCode($code){
		return $this->classeDao->findClasseByCode($code);
		
	}
	
	function saveUtilisateur($user, $classe, $code){
		
		//Gestion de l'etablissement
		$niveau = $this->niveauDao->findNiveau($classe->idNiveau);
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
		$user = $this->utilisateurDao->saveUtilisateur($user, $typeUtilisateur);
		$this->utilisateurDao->addEtablissementToUtilisateur($etablissementId, $user->idUser);
		
		//Association de la classe
		$this->classeDao-> addClasseToUser($user->idUser, $classe->idClasse);
		
		
		envoiMailConfirmationInscription($user);
		
		return $user;
		
	}
	
	function validToken($token){
		return $this->utilisateurDao->activerUtilisateur($token);
	}
	
	
	function envoiMailConfirmationInscription($user){
		//Ajout d'un jeton pour la validation de l'inscription
		$token = generateToken();
		$this->utilisateurDao->ajouterToken($user->idUser, $token) ;
		//envoi du mail
		envoiMailInscription($user,$token);
	}
	
	function sendNewPassword($login){
		$utilisateur = $this->utilisateurDao->findUtilisateurByUsername($login);
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
}
