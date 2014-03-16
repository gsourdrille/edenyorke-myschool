<?php

 interface ClasseDao{
 	
 	function saveClasse($classe);
 	
 	function updateClasse($classe);
 	 	
 	function deleteClasse($idClasse);
 	
 	function findClasse($idClasse);
 	
 	function findClasseByNiveau($idNiveau);
 	
 	function findClasseByNomAndNiveau($nom, $idNiveau);
 	
 	function getClassesByUtlisateur($idUser);
 	
 	function addClassesToUser($idUser, $listeIdClasses);
 	
 	function deleteClassesToUser($idUser, $listeIdClasses);
 	
 	function addClasseToUser($idUser, $idClasse);

 	function deleteClasseToUtilisateurAndEtablissement($idEtablissement, $idUser);
 	
 	function isUniqueClasseCode($code);
 	
 	function findClasseByCode($code);
 	
 	function findClasseByEtablissement($idEtablissement);
 	
 	function buildClasse($row);
 	
 	
 	
 	
 }