<?php

include($_SERVER['DOCUMENT_ROOT']."/myschool/core/include.php");
function getTypeUtilisateur($utilisateur){
	$daoUtilisateur = new UtilisateurDao();
	$typeUtilisateur = $daoUtilisateur->findTypeUtilisateur($utilisateur);
	return $typeUtilisateur;
}


function getEtablissement($etablissementId){
	$daoEtablissement = new EtablissementDao();
	$etablissement = $daoEtablissement->findEtablissement($etablissementId);
	return $etablissement;
}