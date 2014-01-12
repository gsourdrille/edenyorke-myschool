<?php


class StringUtils {

	public static function startswith($haystack, $needle) {
		return substr($haystack, 0, strlen($needle)) === $needle;
	}
	
	

}