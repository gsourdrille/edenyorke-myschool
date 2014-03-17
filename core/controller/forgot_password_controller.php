<?php
require ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/AdminServiceImpl.php");

$adminService = new AdminServiceImpl();

if(isset($_POST)){
	$reponse['error']=false;
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

echo json_encode($reponse);
}