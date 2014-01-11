<?php


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
		$post->fullCreateur = $utilisateurDao->findUtilisateurById($post->createur);
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
	
	return $listePosts;
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
