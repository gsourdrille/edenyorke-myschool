<?php
session_start();
include_once ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/AdminServiceImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/controller/commun_controller.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/utils/StringUtils.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/utils/FileUtils.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");

$logger = new Logger(Config::getProperties(Key::LOGGER_LOCATION));

try{
	$adminService = new AdminServiceImpl();
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
					if($adminService->validateLogin($login, $utilisateur->idUser)){
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
					if($adminService->updateUtilisateur($utilisateur)){
						$_SESSION['USER'] = serialize($utilisateur);
						$succes = "Vos informations ont été mises à jour";
						if(isset($_POST['userfile']) && StringUtils::isNotEmpty($_POST['userfile'])){
							if($_POST['userfile'] == "delete"){
								$adminService->setImageToUtilisateur($utilisateur, null);
								$utilisateur->avatar = null;
								$_SESSION['USER'] = serialize($utilisateur);
							}else{
								$path = FileUtils::createUtilisateurDir($utilisateur->idUser);
								$fileName = substr($_POST['userfile'], strlen(Constants::PATH_TMP)); 
								$adminService->setImageToUtilisateur($utilisateur, $fileName);
								rename(Config::getProperties(Key::PATH_DATA).$_POST['userfile'], $path."/".$fileName);
								$utilisateur->avatar = $fileName;
								$_SESSION['USER'] = serialize($utilisateur);
							}
						}
					}else{
						$succes = "Une erreur est survnue lors de la mise à jour";
					}
						
				}
				require ($_SERVER['DOCUMENT_ROOT']."/html/html/admin/admin_infos/index.php");
			}else if(isset($_POST['action'])){
					$error = null;
					switch($_POST['action']){
						case 'ADD':
						$codeClasse = $_POST['code'];
						if(StringUtils::isEmpty($codeClasse)){
							$error = "Le code classe est vide";
						}else{
							$classe = $adminService->getClasseFromCode($codeClasse);
							if($classe == null){
								$error = "Le code classe n'existe pas";
							}else{
								$niveau = getNiveauById($classe->idNiveau);
								$adminService->addClasseToUser($utilisateur->idUser, $classe->idClasse);
								$adminService->addEtablissementToUser($utilisateur->idUser, $niveau->idEtablissement);
							}
						}
						break;
						case 'DELETE':
							if(isset($_POST['selectClasse'])){
								$listIdClasse = $_POST['selectClasse'];
								$adminService->deleteClassesToUser($utilisateur->idUser, $listIdClasse);
							}else{
								$error = "Veuillez selectionner une ou plusieurs classes";
							}
						break;
					}
					if(StringUtils::isEmpty($error)){
						$array['reponse'] = "ok";
					}else{
						$array['reponse'] = "ko";
						$array['error'] = $error;
					}
					echo json_encode($array);
				
				
			
	}else{
		require ($_SERVER['DOCUMENT_ROOT']."/html/html/admin/admin_infos/index.php");
	}	
}catch (Exception $e){
	$logger->log('erreur', 'liveschool_error', $e->getTraceAsString() , Logger::GRAN_MONTH);
	header("location:/core/controller/erreur_controller.php");
}		