<?php

 interface UtilisateurDao extends BaseDao{
 	
 	public function saveUtilisateur($utilisateur,$type);

 	public function saveUtilisateurTypeUtilisateur($utilisateur,$typesUtlisateurs);

 	public function updateUtilisateur($utilisateur);
 	
 	public function deleteTypeUtilisateur($utilisateur, $typeUtilisateur);
 	
 	public function deleteUtilisateur($idUser);
 	
 	public function findUtilisateur($login,$password);
 	
 	public function findUtilisateurByUsername($login);
 	
 	public function findTypeUtilisateur($utilisateur);
 	
 	public function findUtilisateurByEtablissementAndType($idEtablissement, $type);
 	
 	public function findUtilisateurById($idUser);
 	
 	public function setImageToUtilisateur($iduser, $imageName);
 	
 	public function ajouterToken($idUser, $token);
 	
 	public function activerUtilisateur($token);
 	
 	public function isUniqueToken($token);
 	
 	function saveAutologin($utilisateur,$key);
 	
 	function getUtilisateurByLoginToken($key);
 	
 	function getUtilisateurByEtablissement($idEtablissement);
 	
 	function getUtilisateurByNiveaux($idNiveau);
 	
 	function getUtilisateurByClasses($idClasse);
 	
 	public function addEtablissementToUtilisateur($etablissementId, $userId);
 	
 	public function deleteEtablissementToUtilisateur($etablissementId, $userId);
 	
 	public function buildUtilisateur($row);
 	
 	
 	
 }