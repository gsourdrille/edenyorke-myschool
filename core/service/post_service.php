<?php
require_once  ($_SERVER['DOCUMENT_ROOT']."/core/service/commun_service.php");
require_once  ($_SERVER['DOCUMENT_ROOT']."/core/service/mail_service.php");

function getClassesIdByUser($idUser){
	$classeDao = new ClasseDao();
	$listeClasses =  $classeDao ->getClassesByUtlisateur($idUser);
	return $listeClasses;
}


function getNiveauxIdByClasses($listeClasses){
	$classeDao = new ClasseDao();
	$niveauDao = new NiveauDao();
	$listeNiveauxId = new ArrayObject();
	$listeNiveaux = new ArrayObject();
	foreach ($listeClasses as $classe){
		if(!in_array($classe->idNiveau, (array)$listeNiveauxId)){
			$listeNiveauxId->append($classe->idNiveau);
			$listeNiveaux->append($niveauDao->findNiveau($classe->idNiveau));
		}
	}
	
	return $listeNiveaux;

}


function getAllPost($etablissementId, $listeClasses, $listeNiveaux, $nbResultat, $offset){
	$utilisateur = unserialize($_SESSION['USER']);
	
	$postDao = new PostDao();
	$utilisateurDao = new UtilisateurDao();
	$commentaireDao = new CommentaireDao();
	$pieceJointeDao = new PieceJointeDao();
	
	$listeClassesId = new ArrayObject();
	foreach($listeClasses as $classe){
		$listeClassesId->append($classe->idClasse);
	}
	$listeNiveauxId = new ArrayObject();
	foreach($listeNiveaux as $niveaux){
		$listeNiveauxId->append($niveaux->idNiveau);
	}
	
	$listePosts = $postDao->getAllPosts($etablissementId, $listeClassesId, $listeNiveauxId, $nbResultat, $offset);
	//Pour chaque post
	foreach ($listePosts as $post){
		//Enrichissement du createur
		$createurPost = $utilisateurDao->findUtilisateurById($post->createur);
		$typeUtilisateur = getTypeUtilisateur($createurPost);
		$createurPost->type = getTypeUtilisateurLibelle($typeUtilisateur);
		$post->fullCreateur = $createurPost;
		if($post->createur == $utilisateur->idUser){
			$post->isCreateur = true;
		}
		//Enrichissement des commentaires
		if($post->commentairesActives){
			$listCommentaires = $commentaireDao->findCommentairesFromPost($post->idPost, 0, 5);
			foreach ($listCommentaires as $commentaire){
				$commentaire->fullCreateur = $utilisateurDao->findUtilisateurById($commentaire->idUser);
				if($commentaire->idUser == $utilisateur->idUser){
					$commentaire->isCreateur = true;
				}
			}
			$post->commentaires =$listCommentaires;
		}
		//Enrichissement des pieces jointes
		$post->piecesJointes = $pieceJointeDao ->findPiecesJointesFromPost($post->idPost);
		
		//Enrichissement des associations
		$post->associations = $postDao->getAssociations($post->idPost);
	}
	
	$nbTotalPosts = $postDao->countAllPosts($etablissementId, $listeClassesId, $listeNiveauxId);
	
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
	$postDao = new PostDao();
	$postDao->savePost($post);	
	if($post->associations != null && $post->associations->count()>0){
		$postDao->saveAssociations($post);
	}
	return $post;
}

function setListePieceJointeToPost($idPost, $listePieceJointe){
	$pieceJointeDao = new PieceJointeDao();
	$pieceJointeDao->savePieceJointe($idPost, $listePieceJointe);
}

function addCommentaireToPost($commentaire){
	$commentaireDao = new CommentaireDao();
	$commentaireDao->saveCommentaire($commentaire);
}

function getPost($idPost){
	$postDao = new PostDao();
	$post = $postDao->findPost($idPost);
	return $post;
}

function editPost($post){
	$postDao = new PostDao();
	$postDao->updatePost($post);
	if($post->associations != null && $post->associations->count()>0){
		$postDao->deleteAssociations($post->idPost);
		$postDao->saveAssociations($post);
	}
	return $post;
}

function updateListePieceJointe($idPost,$listePieceJointeToDelete){
	$pieceJointeDao = new PieceJointeDao();
	foreach ($listePieceJointeToDelete as $pjId){
		//suppression physique
		$pj = $pieceJointeDao ->findPieceJointe($pjId);
		FileUtils::deletePostFile($idPost, $pj->path);
		//suppression en base
		$pieceJointeDao->deletePieceJointe($pjId);
	}
}

function getCommentaire($idCommentaire){
	$commentaireDao = new CommentaireDao();
	$commentaire = $commentaireDao->findCommentaire($idCommentaire);
	return $commentaire;
}

function saveCommentaire($commentaire){
	$commentaireDao = new CommentaireDao();
	$commentaire = $commentaireDao->updateCommentaire($commentaire);
}

function deleteCommentaire($idCommentaire){
	$commentaireDao = new CommentaireDao();
	$commentaire = $commentaireDao->deleteCommentaire($idCommentaire);
}


function deletePost($idPost){
	$postDao = new PostDao();
	$postDao->deletePost($idPost);
	FileUtils::deletePostDir($idPost);
}

function getImagesFromPost($idPost){
	$pieceJointeDao = new PieceJointeDao();
	$listeImages = $pieceJointeDao->findImagesFromPost($idPost);
	return $listeImages;
}

function processPieceJointe($postfile,$file,$post,$name){
	$path = FileUtils::createPostDir($post->idPost);
	move_uploaded_file($postfile['tmp_name'][$file], $path."/".$name);
	$pieceJointe = new PieceJointe();
	$pieceJointe->idPost = $post->idPost;
	$pieceJointe->contentType = $postfile['type'][$file];
	$pieceJointe->path = $name;
	return $pieceJointe;
}

function envoiMailNotification($post, $utilisateur){
	$postDao = new PostDao();
	$utilisateurDao = new UtilisateurDao();
	$listeAssociations = $postDao->getAssociations($post->idPost);
	$listeUtilisateurs = Array();
	foreach($listeAssociations as $association){
		switch ($association->typePost){
			case TypePost::ETABLISSEMENT:
				$listeUtilisateursEtablissement = $utilisateurDao->getUtilisateurByEtablissement($association->id);
				$listeUtilisateurs = array_merge($listeUtilisateurs,$listeUtilisateursEtablissement->getArrayCopy());
			break;
			case TypePost::NIVEAU:
				$listeUtilisateursNiveau = $utilisateurDao->getUtilisateurByNiveaux($association->id);
				$listeUtilisateurs = array_merge($listeUtilisateurs,$listeUtilisateursNiveau->getArrayCopy());
			break;
			case TypePost::CLASSE:
				$listeUtilisateursClasse = $utilisateurDao->getUtilisateurByClasses($association->id);
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
