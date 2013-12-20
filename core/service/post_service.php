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
		//Enrichissement des commentaires
		if($post->commentairesActives){
			$listCommentaires = $commentaireDao->findCommentairesFromPost($post->idPost, 0, 5);
			foreach ($listCommentaires as $commentaire){
				$commentaire->fullCreateur = $utilisateurDao->findUtilisateurById($commentaire->idUser);
			}
			$post->commentaires =$listCommentaires;
		}
		//Enrichissement des pieces jointes
		$post->piecesJointes = $pieceJointeDao ->findPiecesJointesFromPost($post->idPost);
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

function setPieceJointeToPost($idPost, $listePieceJointe){
	$pieceJointeDao = new PieceJointeDao();
	$pieceJointeDao->savePieceJointe($idPost, $listePieceJointe);
}
