<?php
 class Config {
 	
 	static function getProperties($key){
 		$filename = $_SERVER['DOCUMENT_ROOT']."/conf/liveschool.ini";
 		$properties = parse_ini_file($filename,false);
 		return $properties[$key];
 	}
 	
 	
 }