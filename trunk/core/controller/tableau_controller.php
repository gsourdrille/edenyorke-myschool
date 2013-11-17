<?php

session_start();

require ('../service/tableau_service.php');


	if(!isset($_SESSION['USER'])){
		session_destroy();
		header("location:/myschool/html/html/login/index.php");
	}else{
		$utilisateur = unserialize($_SESSION['USER']);
		$listeTypeUtilisateur = getTypeUtilisateur($utilisateur);
		if($listeTypeUtilisateur!= null && $listeTypeUtilisateur->count()>0){
			
			$typeUtlisateur = $listeTypeUtilisateur[0];
			switch ($typeUtlisateur){
				case Type_Utilisateur::DIRECTION:
					echo "DIRECTION";
				break;
				case Type_Utilisateur::ENSEIGNANT:
					echo "ENSEIGNANT";
				break;
				case Type_Utilisateur::ELEVE:
					echo "ELEVE";
				break;
				case Type_Utilisateur::PARENT_ELEVE:
					echo "PARENT_ELEVE";
				break;
				
				default:
					echo "DEFAULT";
				break;
			}
			
			
			
		}
				
		
		
	}
	