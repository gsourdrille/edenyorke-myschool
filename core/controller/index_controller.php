<?php
session_start();

require ($_SERVER['DOCUMENT_ROOT'].'/core/service/impl/LoginServiceImpl.php');

$loginService = new LoginServiceImpl();

	// Récupération de la valeur du cookie
	if(isset($_COOKIE['mysauto'])){
	$key = $_COOKIE['mysauto'];
	if(isset($key) && StringUtils::isNotEmpty($key)){
		$utilisateur = $loginService->getUtilisateurByLoginToken($key);
		if($utilisateur != null){
			$_SESSION['USER'] = serialize($utilisateur);
			header("location:/core/controller/tableau_controller.php");
		}else{
			header("location:/html/html/login/index.php");
		}
	}
	}else {
		header("location:/html/html/login/index.php");
	}

