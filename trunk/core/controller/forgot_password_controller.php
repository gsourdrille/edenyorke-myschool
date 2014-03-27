<?php
include_once ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/AdminServiceImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/utils/StringUtils.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");

Logger::configure($_SERVER['DOCUMENT_ROOT']."/conf/log4php.xml");
$logger = Logger::getLogger("LiveSchool");

$adminService = new AdminServiceImpl();
$reponse['error']=false;

if(isset($_POST)){
	try{
		$login = $_POST['username'];
		if(StringUtils::isEmpty($login)){
			$reponse['error'] = true;
			$reponse['error_login']="l'adresse email ne peut être vide";
		}
		if(!$reponse['error']){
			if($adminService->sendNewPassword($login)){
			}else{
				$reponse['error'] = true;
				$reponse['error_login'] = "Utilisateur inconnu";
			}
		}
	}catch (Exception $e){
		$response['error'] = true;
		$response['error_login'] = "Une erreur est survenue lors de la demande de mot de passe";
		$logger->error($e->getTraceAsString() , $e);
	}

echo json_encode($reponse);
}