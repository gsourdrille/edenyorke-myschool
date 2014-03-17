<?php


class StringUtils {

	public static function startsWith($haystack, $needle)
	{
    	return !strncmp($haystack, $needle, strlen($needle));
	}
	
	
	public static function isEmpty($value){
		return $value == null || $value == '';
	}
	
	public static function isNotEmpty($value){
		return $value != null && trim($value) == true ;
	}
	

}