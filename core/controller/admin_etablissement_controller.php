<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/core/service/admin_service.php");

include($_SERVER['DOCUMENT_ROOT']."/core/controller/commun_controller.php");

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
				//upload fichier
				if ($_FILES['imagePrincipale']['error']) {
					switch ($_FILES['imagePrincipale']['error']){
						case 1: // UPLOAD_ERR_INI_SIZE
							$error_image = "Le fichier dépasse la limite autorisée par le serveur !";
							break;
						case 2: // UPLOAD_ERR_FORM_SIZE
							$error_image =  "Le fichier dépasse la limite autorisée dans le formulaire HTML !";
							break;
						case 3: // UPLOAD_ERR_PARTIAL
							$error_image =  "L'envoi du fichier a été interrompu pendant le transfert !";
							break;
					}
				}
				else {
					if ((isset($_FILES['imagePrincipale']['tmp_name'])&&($_FILES['imagePrincipale']['error'] == UPLOAD_ERR_OK))) {
						$path = FileUtils::createEtablissementDir($etablissement->idEtablissement);
						move_uploaded_file($_FILES['imagePrincipale']['tmp_name'], $path."/".$_FILES['imagePrincipale']['name']);
						setImagePrincipaleToEtablissement($etablissement, $_FILES['imagePrincipale']['name']);
						$etablissement->imagePrincipale = $_FILES['imagePrincipale']['name'];
					}
				}
				
				
				//upload fichier
				if ($_FILES['imageFond']['error']) {
					switch ($_FILES['imageFond']['error']){
						case 1: // UPLOAD_ERR_INI_SIZE
							$error_image = "Le fichier dépasse la limite autorisée par le serveur !";
							break;
						case 2: // UPLOAD_ERR_FORM_SIZE
							$error_image =  "Le fichier dépasse la limite autorisée dans le formulaire HTML !";
							break;
						case 3: // UPLOAD_ERR_PARTIAL
							$error_image =  "L'envoi du fichier a été interrompu pendant le transfert !";
							break;
					}
				}
				else {
					if ((isset($_FILES['imageFond']['tmp_name'])&&($_FILES['imageFond']['error'] == UPLOAD_ERR_OK))) {
						$path = FileUtils::createEtablissementDir($etablissement->idEtablissement);
						move_uploaded_file($_FILES['imageFond']['tmp_name'], $path."/".$_FILES['imageFond']['name']);
						setImageFondToEtablissement($etablissement, $_FILES['imageFond']['name']);
						$etablissement->imageFond = $_FILES['imageFond']['name'];
					}
				}
				
			}
			
		}else{
				$succes = "Une erreur est survnue lors de la mise à jour";
			}
		
		
	}

require ($_SERVER['DOCUMENT_ROOT']."/html/html/admin/admin_etablissement/index.php");