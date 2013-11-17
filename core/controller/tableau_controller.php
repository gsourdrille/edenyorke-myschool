<?php

session_start();

require ('../service/tableau_service.php');
require('../logs/Logger.class.php');

		// Creation d'un objet Logger
		$logger = new Logger(Constants::LOGGER_LOCATION);

	if(!isset($_SESSION['USER'])){
		session_destroy();
		header("location:/myschool/html/html/login/index.php");
	}else{
		$utilisateur = unserialize($_SESSION['USER']);
		$listeTypeUtilisateur = getTypeUtilisateur($utilisateur);
		if($listeTypeUtilisateur!= null && $listeTypeUtilisateur->count()>0){
			$logger->log('succes', 'myschool', "tableau_controller.php : Type_utilisateur trouve : ".$listeTypeUtilisateur[0], Logger::GRAN_VOID);
			$_SESSION['TYPE_UTILISATEUR'] = $listeTypeUtilisateur[0];
		}
		$listeEtablissement = getListeEtabliseement($utilisateur);
		if($listeEtablissement!= null && $listeEtablissement->count()>0){
			$etablissement = getEtablissement($listeEtablissement[0]);
			if($etablissement != null){
				$_SESSION['ETABLISSEMENT_ID'] = $etablissement->idEtablissement;
				$logger->log('succes', 'myschool', "tableau_controller.php : etablissement trouve : ".$etablissement->nom, Logger::GRAN_VOID);
			}
		}
		require ("../../html/html/main/index.php");
		
		
	}
	