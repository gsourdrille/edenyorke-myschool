<?php
require ($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/admin_service.php");

if(isset($_POST)){
	$error = false;
	$login = $_POST['username'];
	if(StringUtils::isEmpty($login)){
		$error="Le login ne peut être vide";
	}
	if(StringUtils::isEmpty($error)){
		if(sendNewPassword($login)){
			$array['reponse'] = "ok";
		}else{
			$array['reponse'] = "ko";
			$array['error'] = "Utilisateur inconnu";
		}
	}else{
		$array['reponse'] = "ko";
		$array['error'] = $error;
	}

echo json_encode($array);
}