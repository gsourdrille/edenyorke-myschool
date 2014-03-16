<?php

interface PostService{

	function getClassesIdByUser($idUser);
	
	function getNiveauxIdByClasses($listeClasses);
	
	function getAllPost($etablissementId, $listeClasses, $listeNiveaux, $nbResultat, $offset);
	
	function savePost($post);
	
	function setListePieceJointeToPost($idPost, $listePieceJointe);
	
	function addCommentaireToPost($commentaire);
	
	function getPost($idPost);
	
	function editPost($post);
	
	function updateListePieceJointe($idPost,$listePieceJointeToDelete);
	
	function getCommentaire($idCommentaire);
	
	function saveCommentaire($commentaire);
	
	function deleteCommentaire($idCommentaire);
	
	function deletePost($idPost);
	
	function getImagesFromPost($idPost);
	
	function processPieceJointe($post,$name);
	
	function envoiMailNotification($post, $utilisateur);
	
	function getPj($idPj, $idPost);

}