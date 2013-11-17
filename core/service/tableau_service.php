<?php

include("../include.php");


function getTypeUtilisateur($utilisateur){
	$daoUtilisateur = new UtilisateurDao();
	$typeUtilisateur = $daoUtilisateur->findTypeUtilisateur($utilisateur);
	return $typeUtilisateur;
}

function getListeEtabliseement($utilisateur){
	$daoUtilisateurEtablissement = new UtilisateurEtablissementDao();
	$listeEtablissements = $daoUtilisateurEtablissement->findEtablissementIdByUtilisateur($utilisateur);
	return $listeEtablissements;
}

function getEtablissement($etablissementId){
	$daoEtablissement = new EtablissementDao();
	$etablissement = $daoEtablissement->findEtablissement($etablissementId);
	return $etablissement;
}