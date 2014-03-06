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
				if(isset($_POST['etablissementImagePrincipale']) && StringUtils::isNotEmpty($_POST['etablissementImagePrincipale'])){
					if($_POST['etablissementImagePrincipale'] == "delete"){
						FileUtils::deleteEtablissementImagePrincipale($etablissement);
						$etablissement->imagePrincipale = null;
					}else{
						$path = FileUtils::createEtablissementDir($etablissement->idEtablissement);
						$fileName = substr($_POST['etablissementImagePrincipale'], strlen(Constants::PATH_TMP));
						setImagePrincipaleToEtablissement($etablissement, $fileName);
						rename(Constants::PATH_DATA.$_POST['etablissementImagePrincipale'], $path."/".$fileName);
						$etablissement->imagePrincipale = $fileName;
					}
				}
				
				if(isset($_POST['etablissementImageFond']) && StringUtils::isNotEmpty($_POST['etablissementImageFond'])){
					if($_POST['etablissementImageFond'] == "delete"){
						FileUtils::deleteEtablissementImageFond($etablissement);
						$etablissement->imageFond = null;
					}else{
						$path = FileUtils::createEtablissementDir($etablissement->idEtablissement);
						$fileName = substr($_POST['etablissementImageFond'], strlen(Constants::PATH_TMP));
						setImageFondToEtablissement($etablissement, $fileName);
						rename(Constants::PATH_DATA.$_POST['etablissementImageFond'], $path."/".$fileName);
						$etablissement->imageFond = $fileName;
					}
				}
				
			}
			
		}else{
				$succes = "Une erreur est survnue lors de la mise à jour";
			}
		
		
	}

require ($_SERVER['DOCUMENT_ROOT']."/html/html/admin/admin_etablissement/index.php");