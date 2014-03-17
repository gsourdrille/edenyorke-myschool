<?php
include_once($_SERVER['DOCUMENT_ROOT']."/core/utils/EncryptUtils.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/impl/UtilisateurDaoImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/impl/ClasseDaoImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/service/EncryptService.php");

class EncryptServiceImpl implements EncryptService {
	
	var $utilisateurDao;
	var $classeDao;
	
	function __construct() {
		$this->utilisateurDao = new UtilisateurDaoImpl();
		$this->classeDao = new ClasseDaoImpl();
	}

	function generateUniqueCode(){
		$isNotUnique = true;
		while ($isNotUnique){
			$code = EncryptUtils::generatePassword();
			$isNotUnique = !$this->classeDao->isUniqueClasseCode($code);
		} 
		return $code;
	}
	
	function generateToken(){
		$isNotUnique = true;
		while ($isNotUnique){
			$code = EncryptUtils::generateToken();
			$isNotUnique = !$this->utilisateurDao->isUniqueToken($code);
		}
		return $code;
	}

}