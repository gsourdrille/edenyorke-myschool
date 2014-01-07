<?php

 class FileUtils {
	
	
	public static function createEtablissementDir($idEtablissement){
		
		$basepath = $_SERVER['DOCUMENT_ROOT'].Constants::PATH_IMAGE_ETABLISSEMENT;
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
	
	public static function getEtablissementImagePrinipale($etablissement){
		return Constants::PATH_IMAGE_ETABLISSEMENT.$etablissement->idEtablissement."/".$etablissement->imagePrincipale;
	}
	
	public static function getUtilisateurAvatar($utilisateur){
		return Constants::PATH_IMAGE_UTILISATEUR.$utilisateur->idUser."/".$utilisateur->avatar;
	}
	
	public static function createUtilisateurDir($idUer){
		$basepath = $_SERVER['DOCUMENT_ROOT'].Constants::PATH_IMAGE_UTILISATEUR;
		echo $basepath;
		if( !is_dir($basepath) ){
			mkdir($basepath);
		}
		$path = $basepath.$idUer;
		if( !is_dir($path) ){
			mkdir($path);
		}
	
		return $path;
	}
	
	
	public static function deleteUtilisateurFile($utilisateur){
		$path = $_SERVER['DOCUMENT_ROOT'].Constants::PATH_IMAGE_UTILISATEUR.$utilisateur->idUser;
		if(is_dir($path) ){
			$filename  = $path."/".$utilisateur->avatar;
			if(is_file($filename)){
				unlink($filename);
			}
		}
	}
	
	public static function getPostFile($idPost,$name){
		return Constants::PATH_POST_FILE.$idPost."/".$name;
	}
	
	public static function deletePostFile($idPost,$name){
		$path = $_SERVER['DOCUMENT_ROOT'].Constants::PATH_POST_FILE.$idPost;
		if(is_dir($path) ){
			$filename  = $path."/".$name;
			if(is_file($filename)){
				unlink($filename);
			}
		}
	}
	
	public static function createPostDir($idPost){
	
		$basepath = $_SERVER['DOCUMENT_ROOT'].Constants::PATH_POST_FILE;
		echo $basepath;
		if( !is_dir($basepath) ){
			mkdir($basepath);
		}
		$path = $basepath.$idPost;
		if( !is_dir($path) ){
			mkdir($path);
		}
	
		return $path;
	}
	
}