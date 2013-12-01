<?php

 class FileUtils {
	
	
	public static function createEtablissementDir($idEtablissement){
		
		$basepath = $_SERVER['DOCUMENT_ROOT'].Constants::PATH_IMAGE_ETABLISSEMENT;
		echo $basepath;
		if( !is_dir($basepath) ){
			mkdir($basepath);
		}
		$path = $basepath.$idEtablissement;
		if( !is_dir($path) ){
			mkdir($path);
		}
		
		return $path;
	}
	
	public static function deleteEtablissementFile($etablissement){
	
		$path = $_SERVER['DOCUMENT_ROOT'].Constants::PATH_IMAGE_ETABLISSEMENT.$etablissement->idEtablissement;
		if(is_dir($path) ){
			$filename  = $path."/".$etablissement->imagePrincipale;
			if(is_file($filename)){
			unlink($filename);
			}
		}
	}
	
}