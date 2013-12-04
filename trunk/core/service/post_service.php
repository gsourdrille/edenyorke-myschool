<?php


function getClassesIdByUser($idUser){
	$classeDao = new ClasseDao();
	$listeClasses =  $classeDao ->getClassesByUtlisateur($idUser);
	$listeClassesId = new ArrayObject();
	foreach ($listeClasses as $classe){
		$listeClassesId->append($classe->idClasse);
	}
	return $listeClassesId;

}


function getNiveauxIdByUser($idUser){
	$classeDao = new ClasseDao();
	$listeClasses =  $classeDao ->getClassesByUtlisateur($idUser);
	$listeNiveauxId = new ArrayObject();
	foreach ($listeClasses as $classe){
		if(!in_array($classe->idNiveau, (array)$listeNiveauxId)){
			$listeNiveauxId->append($classe->idNiveau);
		}
	}
	return $listeNiveauxId;

}


function getAllPost($etablissementId, $listeClassesId, $listeNiveauxId, $nbResultat, $offset){
	$postDao = new PostDao();
	$utilisateurDao = new UtilisateurDao();
	$commentaireDao = new CommentaireDao();
	$pieceJointeDao = new PieceJointeDao();
	
	
	$listePosts = $postDao->getAllPosts($etablissementId, $listeClassesId, $listeNiveauxId, $nbResultat, $offset);
	//Pour chaque post
	foreach ($listePosts as $post){
		//Enrichissement du createur
		$post->fullCreateur = $utilisateurDao->findUtilisateurById($post->createur);
		//Enrichissement des commentaires
		if($post->commentairesActives){
			$post->commentaires = $commentaireDao->findCommentairesFromPost($post->idPost, 0, 5);
		}
		//Enrichissement des pieces jointes
		$post->piecesJointes = $pieceJointeDao ->findPiecesJointesFromPost($post->idPost);
	}
	
	return $listePosts;
}