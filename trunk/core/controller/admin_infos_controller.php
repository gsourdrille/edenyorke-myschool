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
			$utilisateur->nom = $nom;
		}
		$prenom = $_POST['prenom'];
		if($prenom == null || trim($prenom) == false){
			$error_prenom="Le prénom ne peut être vide";
			$error = true;
		}else{
			$utilisateur->prenom = $prenom;
		}
		$login = $_POST['login'];
		if($login == null || trim($login) == false){
			$error_login="Le login ne peut être vide";
			$error = true;
		}else{
			if(validateLogin($login, $utilisateur->idUser)){
				$utilisateur->login = $login;
			}else{
				$error_login="Ce login est déjà utilisé, veuillez en choisir un autre";
				$error = true;
			}
		}
		$ancienMdp = $_POST['ancien_mdp'];
		if($ancienMdp != null && trim($ancienMdp) == true){
			if(sha1($ancienMdp) != $utilisateur->mdp){
				$error_password="L'ancien mot de passe n'est pas correct";
				$error = true;
			}else{
				$nouveauMdp = $_POST['nouveau_mdp'];
				if($nouveauMdp != null && trim($nouveauMdp) == true){
					$nouveauMdpBis = $_POST['nouveau_mdp_bis'];
					if($nouveauMdpBis != null && trim($nouveauMdpBis) == true){
						if($nouveauMdp != $nouveauMdpBis){
							$error_new_password="Les mots de passe ne correspondent pas";
							$error = true;
						}else{
							$utilisateur->mdp = sha1($nouveauMdp);
							$changeMdp=true;
						}
					}
				}
			}
		}
		if($error==false){
			if(updateUtilisateur($utilisateur)){
				$_SESSION['USER'] = serialize($utilisateur);
				$succes = "Vos informations ont été mises à jour";
				//upload fichier
				if ($_FILES['userfile']['error']) {
					switch ($_FILES['userfile']['error']){
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
					if ((isset($_FILES['userfile']['tmp_name'])&&($_FILES['userfile']['error'] == UPLOAD_ERR_OK))) {
						$path = FileUtils::createUtilisateurDir($utilisateur->idUser);
						move_uploaded_file($_FILES['userfile']['tmp_name'], $path."/".$_FILES['userfile']['name']);
						setImageToUtilisateur($utilisateur, $_FILES['userfile']['name']);
						$utilisateur->avatar = $_FILES['userfile']['name'];
						$_SESSION['USER'] = serialize($utilisateur);
					}
				}
			}else{
				$succes = "Une erreur est survnue lors de la mise à jour";
			}
			
		}
	}
	
	//Maj de la liste des classes
	$listeClasse = getClassesByUser($utilisateur->idUser);
	


require ($_SERVER['DOCUMENT_ROOT']."/myschool/html/html/admin/admin_infos/index.php");