<?php

session_start();
require ($_SERVER['DOCUMENT_ROOT'].'/core/service/impl/LoginServiceImpl.php');
require ($_SERVER['DOCUMENT_ROOT'].'/core/service/impl/CommunServiceImpl.php');

	$response['error'] = false;

	$username=trim($_POST['username']);
	$password=trim($_POST['password']);

	$loginService = new LoginServiceImpl();
	$communService = new CommunServiceImpl();
	
	$utilisateur = $loginService->connect($username,$password);
	if($utilisateur != null){
		$_SESSION['USER'] = serialize($utilisateur);
		$_SESSION['ETABLISSEMENT_ID'] = $communService->getFirstEtablissement($utilisateur);
		if(isset($_POST['autologin']) && $_POST['autologin']){
			saveAutologin($utilisateur);
		}
	}else{
		$response['error'] = true;
		$response['error_login'] = "Utilisateur inconnu";
		
	}
	echo json_encode($response);