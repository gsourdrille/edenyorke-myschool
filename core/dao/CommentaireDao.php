<?php

interface CommentaireDao extends BaseDao{
	
	
	public function saveCommentaire($commentaire);
	
	public function updateCommentaire ($commentaire);
	
	public function deleteCommentaire($idCommentaire);
	
	public function deleteCommentaireToUtilisateur($idUser);
	
	public function findCommentairesFromPost($idPost, $offset, $nbResultat);
	
	public function findCommentaire($idCommentaire);
	
	public function countCommentairesFromPost($idPost);
	
	public function buildCommentaire($row);
	
}