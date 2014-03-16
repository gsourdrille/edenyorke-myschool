<?php
include_once($_SERVER['DOCUMENT_ROOT']."/core/service/impl/CommunServiceImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/service/mail_service.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/utils/FileUtils.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/service/PostService.php");

class PostServiceImpl implements PostService {
	
	var $classeDao;
	var $niveauDao;
	var $utilisateurDao;
	var $postDao;
	var $commentaireDao;
	var $pieceJointeDao;
	
	var $communService;
	
	function __construct() {
		$this->classeDao = new ClasseDaoImpl();
		$this->niveauDao = new NiveauDaoImpl();
		$this->utilisateurDao = new UtilisateurDaoImpl();
		$this->commentaireDao = new CommentaireDaoImpl();
		$this->pieceJointeDao = new PieceJointeDaoImpl();
		
		$this->communService = new CommunServiceImpl();
	}

function getClassesIdByUser($idUser){
	$listeClasses =  $this->classeDao->getClassesByUtlisateur($idUser);
	return $listeClasses;
}


function getNiveauxIdByClasses($listeClasses){
	$listeNiveauxId = new ArrayObject();
	$listeNiveaux = new ArrayObject();
	foreach ($listeClasses as $classe){
		if(!in_array($classe->idNiveau, (array)$listeNiveauxId)){
			$listeNiveauxId->append($classe->idNiveau);
			$listeNiveaux->append($this->niveauDao->findNiveau($classe->idNiveau));
		}
	}
	
	return $listeNiveaux;

}


function getAllPost($etablissementId, $listeClasses, $listeNiveaux, $nbResultat, $offset){
	$utilisateur = unserialize($_SESSION['USER']);
	$typeUtilisateur = $_SESSION['TYPE_UTILISATEUR'];
	
	$listeClassesId = new ArrayObject();
	foreach($listeClasses as $classe){
		$listeClassesId->append($classe->idClasse);
	}
	$listeNiveauxId = new ArrayObject();
	foreach($listeNiveaux as $niveaux){
		$listeNiveauxId->append($niveaux->idNiveau);
	}
	
	$listePosts = $this->postDao->getAllPosts($etablissementId, $listeClassesId, $listeNiveauxId, $nbResultat, $offset,$typeUtilisateur);
	//Pour chaque post
	foreach ($listePosts as $post){
		//Enrichissement du createur
		$createurPost = $this->utilisateurDao->findUtilisateurById($post->createur);
		$typeUtilisateur = $this->communService->getTypeUtilisateur($createurPost);
		$createurPost->type = $this->communService->getTypeUtilisateurLibelle($typeUtilisateur);
		$post->fullCreateur = $createurPost;
		if($post->createur == $utilisateur->idUser){
			$post->isCreateur = true;
		}
		//Enrichissement des commentaires
		if($post->commentairesActives){
			$listCommentaires = $this->commentaireDao->findCommentairesFromPost($post->idPost, 0, 5);
			foreach ($listCommentaires as $commentaire){
				$commentaire->fullCreateur = $utilisateurDao->findUtilisateurById($commentaire->idUser);
				if($commentaire->idUser == $utilisateur->idUser){
					$commentaire->isCreateur = true;
				}
			}
			$post->commentaires =$listCommentaires;
		}
		//Enrichissement des pieces jointes
		$post->piecesJointes = $this->pieceJointeDao->findPiecesJointesFromPost($post->idPost);
		
		//Enrichissement des associations
		$post->associations = $this->postDao->getAssociations($post->idPost);
	}
	
	$nbTotalPosts = $this->postDao->countAllPosts($etablissementId, $listeClassesId, $listeNiveauxId, $typeUtilisateur);
	
	$resultListePoste = new ResultListePosts();
	$resultListePoste->listePost = $listePosts;
	$nextOffset = $offset+Constants::DEFAUT_MAX_RESULT;
	
	if($nbTotalPosts > $nextOffset){
		$resultListePoste->hasMorePosts = true;
	}else{
		$resultListePoste->hasMorePosts = false;
	}
	
	return $resultListePoste;
}

function savePost($post){
	$this->postDao->savePost($post);	
	if($post->associations != null && $post->associations->count()>0){
		$this->postDao->saveAssociations($post);
	}
	return $post;
}

function setListePieceJointeToPost($idPost, $listePieceJointe){
	$this->pieceJointeDao->savePieceJointe($idPost, $listePieceJointe);
}

function addCommentaireToPost($commentaire){
	$this->commentaireDao->saveCommentaire($commentaire);
}

function getPost($idPost){
	$this->post = $postDao->findPost($idPost);
	return $post;
}

function editPost($post){
	$this->post->updatePost($post);
	if($post->associations != null && $post->associations->count()>0){
		$postDao->deleteAssociations($post->idPost);
		$postDao->saveAssociations($post);
	}
	return $post;
}

function updateListePieceJointe($idPost,$listePieceJointeToDelete){
	foreach ($listePieceJointeToDelete as $pjId){
		//suppression physique
		$pj = $this->pieceJointeDao->findPieceJointe($pjId,$idPost);
		FileUtils::deletePostFile($idPost, $pj->path);
		//suppression en base
		$this->pieceJointeDao->deletePieceJointe($pjId);
	}
}

function getCommentaire($idCommentaire){
	$commentaire = $this->commentaireDao->findCommentaire($idCommentaire);
	return $commentaire;
}

function saveCommentaire($commentaire){
	$commentaire = $this->commentaireDao->updateCommentaire($commentaire);
}

function deleteCommentaire($idCommentaire){
	$commentaire = $this->commentaireDao->deleteCommentaire($idCommentaire);
}


function deletePost($idPost){
	$this->postDao->deletePost($idPost);
	FileUtils::deletePostDir($idPost);
}

function getImagesFromPost($idPost){
	$listeImages = $this->pieceJointeDao->findImagesFromPost($idPost);
	return $listeImages;
}

function processPieceJointe($post,$name){
	$path = FileUtils::createPostDir($post->idPost);
	rename(Config::getProperties(Key::PATH_DATA).Constants::PATH_TMP.$name, $path."/".$name);
	$pieceJointe->idPost = $post->idPost;
	$pieceJointe->contentType = FileUtils::getContentType($name);
	$pieceJointe->path = $name;
	return $pieceJointe;
}

function envoiMailNotification($post, $utilisateur){
	$listeAssociations = $this->postDao->getAssociations($post->idPost);
	$listeUtilisateurs = Array();
	foreach($listeAssociations as $association){
		switch ($association->typePost){
			case TypePost::ETABLISSEMENT:
				$listeUtilisateursEtablissement = $this->utilisateurDao->getUtilisateurByEtablissement($association->id);
				$listeUtilisateurs = array_merge($listeUtilisateurs,$listeUtilisateursEtablissement->getArrayCopy());
			break;
			case TypePost::NIVEAU:
				$listeUtilisateursNiveau = $this->utilisateurDao->getUtilisateurByNiveaux($association->id);
				$listeUtilisateurs = array_merge($listeUtilisateurs,$listeUtilisateursNiveau->getArrayCopy());
			break;
			case TypePost::CLASSE:
				$listeUtilisateursClasse = $this->utilisateurDao->getUtilisateurByClasses($association->id);
				$listeUtilisateurs = array_merge($listeUtilisateurs,$listeUtilisateursClasse->getArrayCopy());
			break;
		}
		$listeUtilisateurs = array_unique($listeUtilisateurs);
		
	}
	
	if(($key = array_search($utilisateur->idUser, $listeUtilisateurs)) !== false) {
		unset($listeUtilisateurs[$key]);
	}
	
	
	envoiMailNotificationPost($post, $utilisateur, $listeUtilisateurs);
	
}

function getPj($idPj, $idPost){
	return $this->pieceJointeDao->findPieceJointe($idPj, $idPost);
}

}
