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
	
	public static function cleanCaracteresSpeciaux ($chaine)
	{
		setlocale(LC_ALL, 'fr_FR');
		$chaine = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $chaine);
		$chaine = preg_replace('#[^0-9a-z.]+#i', '-', $chaine);
		while(strpos($chaine, '--') !== false)
		{
			$chaine = str_replace('--', '-', $chaine);
		}
		$chaine = trim($chaine, '-');
		return $chaine;
	}
	

}