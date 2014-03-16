<?php



 interface PostDao extends  BaseDao{
 	
 	public function savePost($post);
 	
 	public function saveAssociations($post);
 	
 	public function getAssociations($idPost);
 	
 	public function deleteAssociations($idPost);
 	
 	public function updatePost($post);
 	 	
 	public function deletePost($idPost);
 	
 	public function getPostFromUtilisateur($idUser);
 	
 	public function findPost($idPost);
 	
 	public function getAllPosts($idEtablissement, $idClasses, $idsNiveaux, $nbResultat, $offset, $typeUtilisateur);
 	
 	public function countAllPosts($idEtablissement, $idClasses, $idsNiveaux, $typeUtilisateur);
 	
 	public function buildPost($row);
 	
 	 	
 	
 }