<?php

function envoiMailInscription($utilisateur,$token){
	
	 $headers ='From: "'.Constants::MAIL_FROM_NAME.'"<'.Constants::MAIL_FROM.'>'."\n"; 
     $headers .='Reply-To: '.Constants::MAIL_REPLY_TO.''."\n"; 
     $headers .='Content-Type: text/html; charset=utf-8"'."\n"; 
     $headers .='Content-Transfer-Encoding: 8bit';

     $template=  file_get_contents($_SERVER['DOCUMENT_ROOT']."/myschool/html/mail/template_inscription.html");
     $parametre = array();
     $parametre['USER_FULLNAME']= $utilisateur->fullname();
     $parametre['VALIDATION_LINK']=Constants::MAIL_VALID_URL_REPONSE.$token;
     
     foreach ($parametre as $key=> $value){
     	$template = str_replace('{{ '.$key.' }}', $value, $template);
     }
     
     mail($utilisateur->login, 'Validation inscription MySchool', $template, $headers);
	
}

function envoiMailConfirmationEnvoiPassword($utilisateur,$motdepasse){
	
	$headers ='From: "'.Constants::MAIL_FROM_NAME.'"<'.Constants::MAIL_FROM.'>'."\n";
	$headers .='Reply-To: '.Constants::MAIL_REPLY_TO.''."\n";
	$headers .='Content-Type: text/html; charset=utf-8"'."\n";
	$headers .='Content-Transfer-Encoding: 8bit';
	$message ='<html><head><title>Votre nouveau mot de passe MySchool</title></head><body>Votre mot de passe a été reinitialisé. Votre nouveau mot de passe est : '.$motdepasse.'</body></html>';
	mail($utilisateur->login, 'Votre nouveau mot de passe MySchool', $message, $headers);
}

function envoiMailDemandeInscription($etablissement, $utilisateur){
	$headers ='From: "'.Constants::MAIL_FROM_NAME.'"<'.Constants::MAIL_FROM.'>'."\n";
	$headers .='Reply-To: '.Constants::MAIL_REPLY_TO.''."\n";
	$headers .='Content-Type: text/html; charset=utf-8"'."\n";
	$headers .='Content-Transfer-Encoding: 8bit';
	$message ='<html><head><meta http-equiv="content-type" content="text/html; charset=utf-8" /> <title>Demande d\'inscription MySchool !</title></head><body>Données : <br/>Nom etablissement : ' .$etablissement->nom.'<br/>Telephone '.$etablissement->telephone1.'<br/>Email '.$utilisateur->login.'<br/>Nom '.$utilisateur->nom.'<br/>Prenom '.$utilisateur->prenom.'<br/>Mot de passe '.$utilisateur->mdp.'</body></html>';
	mail(Constants::MAIL_DEMANDE_INCRIPTION, 'Nouvelle inscription !', utf8_decode($message), $headers);
	return true;
}

function envoiMailNotificationPost($post, $utilisateur, $listeUtilisateurs){
	foreach ($listeUtilisateurs as $user){
		$logger = new Logger(Constants::LOGGER_LOCATION);
		$logger->log('mail', 'myschool', "USER : ".$user->login , Logger::GRAN_VOID);
		
		$headers ='From: "'.Constants::MAIL_FROM_NAME.'"<'.Constants::MAIL_FROM.'>'."\n";
		$headers .='Reply-To: '.Constants::MAIL_REPLY_TO.''."\n";
		$headers .='Content-Type: text/html; charset=utf-8"'."\n";
		$headers .='Content-Transfer-Encoding: 8bit';
		$message ='<html><head><meta http-equiv="content-type" content="text/html; charset=utf-8" /> <title>Nouveau message de '.$utilisateur->fullName().'</title></head><body>Bonjour '.$user->fullName().'<br/> '.$utilisateur->fullName().' a posté un nouveau message : <br/>'.$post->contenu.'</body></html>';
		mail($user->login, 'Nouveau message !', utf8_decode($message), $headers);
	}
}

