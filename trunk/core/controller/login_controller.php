<?php

session_start();

require ($_SERVER['DOCUMENT_ROOT'].'/myschool/core/service/login_service.php');

	$username=trim($_POST['username']);
	$password=trim($_POST['password']);

	$utilisateur = connect($username,$password);
	if($utilisateur != null){
		$_SESSION['USER'] = serialize($utilisateur);
		header("location:/myschool/core/controller/tableau_controller.php");
	}else{
		$error = "Utilisateur inconnu";
		require ($_SERVER['DOCUMENT_ROOT']."/myschool/html/html/login/index.php");
	}
