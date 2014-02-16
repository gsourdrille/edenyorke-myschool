<?php

session_start();
require ($_SERVER['DOCUMENT_ROOT'].'/myschool/core/service/login_service.php');

	$response['error'] = false;

	$username=trim($_POST['username']);
	$password=trim($_POST['password']);

	$utilisateur = connect($username,$password);
	if($utilisateur != null){
		$_SESSION['USER'] = serialize($utilisateur);
		if(isset($_POST['autologin']) && $_POST['autologin']){
			saveAutologin($utilisateur);
		}
	}else{
		$response['error'] = true;
		$response['error_login'] = "Utilisateur inconnu";
		
	}
	echo json_encode($response);