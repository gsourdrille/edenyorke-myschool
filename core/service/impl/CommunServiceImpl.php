<?php

include_once($_SERVER['DOCUMENT_ROOT']."/core/bean/Utilisateur.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/bean/Etablissement.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/impl/UtilisateurDaoImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/impl/EtablissementDaoImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/service/CommunService.php");

class CommunServiceImpl implements CommunService {
	
	var $utilisateurDao;
	var $etablissementDao;
	
	function __construct() {
		$this->utilisateurDao = new UtilisateurDaoImpl();
		$this->etablissementDao = new EtablissementDaoImpl();
	}
	

	function getTypeUtilisateur($utilisateur){
		$listeTypeUtilisateur = $this->utilisateurDao->findTypeUtilisateur($utilisateur);
		if($listeTypeUtilisateur!= null && $listeTypeUtilisateur->count()>0){
			return $listeTypeUtilisateur[0];
		}
		return null;
	}
	
	
	function getEtablissement($etablissementId){
		$etablissement = $this->etablissementDao->findEtablissement($etablissementId);
		return $etablissement;
	}
	
	function getEtablissementFromUser($idUser){
		return $this->etablissementDao->getEtablissementsFromUser($idUser);
	}
	
	function getTypeUtilisateurLibelle($typeUtilisateur){
		$libelle = "";
		switch ($typeUtilisateur){
			case TypeUtilisateur::DIRECTION:
				$libelle="Direction";
				break;
			case TypeUtilisateur::ENSEIGNANT:
				$libelle="Enseignant";
				break;
			case TypeUtilisateur::ELEVE:
				$libelle="Elève";
				break;
		}
		return $libelle; 
	}
	
	function getFirstEtablissement($utilisateur){
		$listeEtablissement = $this->etablissementDao->getEtablissementsFromUser($utilisateur->idUser);
		if($listeEtablissement->count()>0){
			return $listeEtablissement[0]->idEtablissement;
		}
	}

}