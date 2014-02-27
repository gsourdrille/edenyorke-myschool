<?php

 class FileUtils {
	
	
	public static function createEtablissementDir($idEtablissement){
		
		$basepath = Constants::PATH_DATA.Constants::PATH_IMAGE_ETABLISSEMENT;
		if( !is_dir($basepath) ){
			mkdir($basepath);
		}
		$path = $basepath.$idEtablissement;
		if( !is_dir($path) ){
			mkdir($path);
		}
		
		return $path;
	}
	
	public static function deleteEtablissementImagePrincipale($etablissement){
	
		$path = Constants::PATH_DATA.Constants::PATH_IMAGE_ETABLISSEMENT.$etablissement->idEtablissement;
		if(is_dir($path) ){
			$filename  = $path."/".$etablissement->imagePrincipale;
			if(is_file($filename)){
			unlink($filename);
			}
		}
	}
	
	public static function deleteEtablissementImageFond($etablissement){
	
		$path = Constants::PATH_DATA.Constants::PATH_IMAGE_ETABLISSEMENT.$etablissement->idEtablissement;
		if(is_dir($path) ){
			$filename  = $path."/".$etablissement->imageFond;
			if(is_file($filename)){
				unlink($filename);
			}
		}
	}
	
	public static function getEtablissementImagePrincipale($etablissement){
		return Constants::PATH_IMAGE_ETABLISSEMENT.$etablissement->idEtablissement."/".$etablissement->imagePrincipale;
	}
	
	public static function getEtablissementImageFond($etablissement){
		return Constants::PATH_IMAGE_ETABLISSEMENT.$etablissement->idEtablissement."/".$etablissement->imageFond;
	}
	
	public static function getUtilisateurAvatar($utilisateur){
		return Constants::PATH_IMAGE_UTILISATEUR.$utilisateur->idUser."/".$utilisateur->avatar;
	}
	
	public static function createUtilisateurDir($idUer){
		$basepath = Constants::PATH_DATA.Constants::PATH_IMAGE_UTILISATEUR;
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
		$path = Constants::PATH_DATA.Constants::PATH_IMAGE_UTILISATEUR.$utilisateur->idUser;
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
		$path = Constants::PATH_DATA.Constants::PATH_POST_FILE.$idPost;
		if(is_dir($path) ){
			$filename  = $path."/".$name;
			if(is_file($filename)){
				unlink($filename);
			}
		}
	}
	
	public static function createPostDir($idPost){
	
		$basepath = Constants::PATH_DATA.Constants::PATH_POST_FILE;
		if( !is_dir($basepath) ){
			mkdir($basepath);
		}
		$path = $basepath.$idPost;
		if( !is_dir($path) ){
			mkdir($path);
		}
	
		return $path;
	}
	
	public static function deletePostDir($idPost){
	
		$basepath = Constants::PATH_DATA.Constants::PATH_POST_FILE;
		if( is_dir($basepath) ){
			$path = $basepath.$idPost;
			if( is_dir($path) ){
				foreach(glob($path . '/*') as $file) { 
    				unlink($file); 
  				} 
  				rmdir($path); 
			}
		}
	}
	
	
	public static function getContentType($file){
		$mime_types = array(
				'txt' => 'text/plain',
				'htm' => 'text/html',
				'html' => 'text/html',
				'php' => 'text/html',
				'css' => 'text/css',
				'js' => 'application/javascript',
				'json' => 'application/json',
				'xml' => 'application/xml',
				'swf' => 'application/x-shockwave-flash',
				'flv' => 'video/x-flv',
				 
				// images
				'png' => 'image/png',
				'jpe' => 'image/jpeg',
				'jpeg' => 'image/jpeg',
				'jpg' => 'image/jpeg',
				'gif' => 'image/gif',
				'bmp' => 'image/bmp',
				'ico' => 'image/vnd.microsoft.icon',
				'tiff' => 'image/tiff',
				'tif' => 'image/tiff',
				'svg' => 'image/svg+xml',
				'svgz' => 'image/svg+xml',
				 
				// archives
				'zip' => 'application/zip',
				'rar' => 'application/x-rar-compressed',
				'exe' => 'application/x-msdownload',
				'msi' => 'application/x-msdownload',
				'cab' => 'application/vnd.ms-cab-compressed',
				 
				// audio/video
				'mp3' => 'audio/mpeg',
				'qt' => 'video/quicktime',
				'mov' => 'video/quicktime',
				 
				// adobe
				'pdf' => 'application/pdf',
				'psd' => 'image/vnd.adobe.photoshop',
				'ai' => 'application/postscript',
				'eps' => 'application/postscript',
				'ps' => 'application/postscript',
				 
				// ms office
				'doc' => 'application/msword',
				'rtf' => 'application/rtf',
				'xls' => 'application/vnd.ms-excel',
				'ppt' => 'application/vnd.ms-powerpoint',
				 
				// open office
				'odt' => 'application/vnd.oasis.opendocument.text',
				'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
		);
		 
		$infos = explode('.', $file);
		$ext = strtolower(array_pop($infos));
		if (array_key_exists($ext, $mime_types)) {
			return $mime_types[$ext];
		}
		elseif (function_exists('finfo_open')) {
			$finfo = finfo_open(FILEINFO_MIME);
			$mimetype = finfo_file($finfo, $file);
			finfo_close($finfo);
			return $mimetype;
		}
		else {
			return 'application/octet-stream';
		}
	}
}