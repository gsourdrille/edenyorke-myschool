<?php
require ($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/admin_service.php");

if(isset($_GET['token'])){
	$token = $_GET['token'];
	if(validToken($token)){
		$validInscription = true;
	}else{
		$validInscription = false;
	}
	
}else{
	$validInscription = false;
}

require ($_SERVER['DOCUMENT_ROOT']."/myschool/html/html/login/index.php");