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

function getEtablissementFromUser($idUser){
	$etablissementDao = new EtablissementDao();
	return $etablissementDao->getEtablissementsFromUser($idUser);
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

function getFirstEtablissement($utilisateur){
	$etablissementDao = new EtablissementDao();
	$listeEtablissement = $etablissementDao->getEtablissementsFromUser($utilisateur->idUser);
	if($listeEtablissement->count()>0){
		return $listeEtablissement[0]->idEtablissement;
	}
}