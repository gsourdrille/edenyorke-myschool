<?php

include($_SERVER['DOCUMENT_ROOT']."/core/include.php");
function getTypeUtilisateur($utilisateur){
	$daoUtilisateur = new UtilisateurDao();
	$listeTypeUtilisateur = $daoUtilisateur->findTypeUtilisateur($utilisateur);
	if($listeTypeUtilisateur!= null && $listeTypeUtilisateur->count()>0){
		return $listeTypeUtilisateur[0];
	}
	return null;
}


function getEtablissement($etablissementId){
	$daoEtablissement = new EtablissementDao();
	$etablissement = $daoEtablissement->findEtablissement($etablissementId);
	return $etablissement;
}

function getTypeUtilisateurLibelle($typeUtilisateur){
	$libelle = "";
	switch ($typeUtilisateur){
		case Type_Utilisateur::DIRECTION:
			$libelle="Direction";
			break;
		case Type_Utilisateur::ENSEIGNANT:
			$libelle="Enseignant";
			break;
		case Type_Utilisateur::ELEVE:
			$libelle="Elève";
			break;
	}
	return $libelle; 
}