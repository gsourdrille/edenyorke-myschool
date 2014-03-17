<?php
include_once ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/AdminServiceImpl.php");

$adminService = new AdminServiceImpl();

if(isset($_GET['token'])){
	$token = $_GET['token'];
	if($adminService->validToken($token)){
		$validInscription = true;
	}else{
		$validInscription = false;
	}
	
}else{
	$validInscription = false;
}

require ($_SERVER['DOCUMENT_ROOT']."/html/html/login/index.php");