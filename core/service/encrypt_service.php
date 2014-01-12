<?php

include_once($_SERVER['DOCUMENT_ROOT']."/myschool/core/include.php");

 function generateUniqueCode(){
	$isNotUnique = true;
	$classeDao = new ClasseDao();
	while ($isNotUnique){
		$code = EncryptUtils::generatePassword();
		$isNotUnique = $classeDao->isUniqueClasseCode($code);
	} 
	return $code;
}