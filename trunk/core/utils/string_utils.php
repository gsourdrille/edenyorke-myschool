<?php


class StringUtils {

	public static function startswith($haystack, $needle) {
		return substr($haystack, 0, strlen($needle)) === $needle;
	}
	
	public static function isEmpty($value){
		return $value == null || $value == '';
	}
	
	public static function isNotEmpty($value){
		return $value != null && trim($value) == true ;
	}
	

}