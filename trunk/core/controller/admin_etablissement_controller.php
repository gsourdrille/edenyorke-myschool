<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/admin_service.php");


// Creation d'un objet Logger
$logger = new Logger(Constants::LOGGER_LOCATION);

include($_SERVER['DOCUMENT_ROOT']."/myschool/core/controller/commun_controller.php");

if (isset($_POST['submit'])){
	
		$error = false;
		$nom = $_POST['nom'];
		if($nom == null || trim($nom) == false){
			$error_nom="Le nom ne peut être vide";
			$error = true;
		}else{
			$etablissement->nom = $nom;
		}
		$adresse = $_POST['adresse'];
		if($adresse == null || trim($adresse) == false){
			$error_prenom="L'adresse ne peut être vide";
			$error = true;
		}else{
			$etablissement->adresse = $adresse;
		}
		$codepostal = $_POST['codepostal'];
		if($codepostal == null || trim($codepostal) == false){
			$error_codepostal="Le code postal ne peut être vide";
			$error = true;
		}else{
			$etablissement->codePostal = $codepostal;
		}
		$ville = $_POST['ville'];
		if($ville == null || trim($ville) == false){
			$error_ville="La ville ne peut être vide";
			$error = true;
		}else{
			$etablissement->ville = $ville;
		}
		$telephone1 = $_POST['telephone1'];
		if($telephone1 == null || trim($telephone1) == false){
			$error_telephone1="Le numéro de téléphone ne peut être vide";
			$error = true;
		}else{
			$etablissement->telephone1 = $telephone1;
		}
		$telephone2 = $_POST['telephone2'];
		$etablissement->telephone2 = $telephone2;
		
		$fax = $_POST['fax'];
		$etablissement->fax = $fax;
		
		if($error==false){
			if(updateEtablissement($etablissement)){
				$succes = "Vos informations ont été mises à jour";
			}else{
				$succes = "Une erreur est survnue lors de la mise à jour";
			}
			
		}
	}

require ($_SERVER['DOCUMENT_ROOT']."/myschool/html/html/admin/admin_etablissement/index.php");