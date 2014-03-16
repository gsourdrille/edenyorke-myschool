<?php

interface AdminService {
	

	function validateLogin($username, $userId);
	
	function updateUtilisateur($utilisateur);
	
	function saveOrUpdateUtilisateur($utilisateur,$type, $etablissementId);
	
	function updateEtablissement($etablissement);
	
	function setImagePrincipaleToEtablissement($etablissement, $imageName);
	
	function setImageFondToEtablissement($etablissement, $imageName);
	
	function setImageToUtilisateur($utilisateur, $imageName);
	
	function getNiveauxByEtablissement($idEtablissement);
	
	function getClassesByEtablissement($idEtablissement);
	
	function getNiveauById($idNiveau);
	
	function validateNiveau($nom, $niveauId,$etablissementId);
	
	function saveOrUpdateNiveau($niveau);
	
	function deleteNiveau($idNiveau);
	
	function getClasseById($idClasse);
	
	function validateClasse($nom, $idClasse,$idNiveau);
	
	function saveOrUpdateClasse($classe);
	
	function deleteClasse($idClasse);
	
	function getClassesByNiveau($idNiveau);
	
	function getUserByEtablissementAndType($idEtablissement, $type);
	
	function getUserById($idUser);
	
	function deleteUser($idUser);
	
	function deleteEtablissementToUtilisateur($idEtablissement,$idUser);
	
	function getAllClassesForEtablissement($idEtablissement);
	
	function getAllNiveauxForEtablissement($idEtablissement);
	
	function getClassesByUser($idUser);
	
	function addClassesToUser($idUser, $listeIdClasses);
	
	function addClasseToUser($idUser, $idClasse);
	
	function addEtablissementToUser($idUser, $idEtablissement);
	
	function deleteClassesToUser($idUser, $listeIdClasse);
	
	function getClasseFromCode($code);
	
	function saveUtilisateur($user, $classe, $code);
	
	function validToken($token);
	
	function envoiMailConfirmationInscription($user);
	
	function sendNewPassword($login);

}