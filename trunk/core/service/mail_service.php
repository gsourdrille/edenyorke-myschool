<?php

function envoiMailInscription($utilisateur,$token){
	
	 $headers ='From: "'.Constants::MAIL_FROM_NAME.'"<'.Constants::MAIL_FROM.'>'."\n"; 
     $headers .='Reply-To: '.Constants::MAIL_REPLY_TO.''."\n"; 
     $headers .='Content-Type: text/html; charset=utf-8"'."\n"; 
     $headers .='Content-Transfer-Encoding: 8bit';

     $template=  file_get_contents($_SERVER['DOCUMENT_ROOT']."/html/mail/template_inscription.html");
     $parametre = array();
     $parametre['USER_FULLNAME']= $utilisateur->fullname();
     $parametre['VALIDATION_LINK']=Constants::MAIL_VALID_URL_REPONSE.$token;
     
     foreach ($parametre as $key=> $value){
     	$template = str_replace('{{ '.$key.' }}', $value, $template);
     }
     
     mail($utilisateur->login, 'Validation inscription LiveSchool', utf8_decode($template), $headers);
	
}

function envoiMailConfirmationEnvoiPassword($utilisateur,$motdepasse){
	
	$headers ='From: "'.Constants::MAIL_FROM_NAME.'"<'.Constants::MAIL_FROM.'>'."\n";
	$headers .='Reply-To: '.Constants::MAIL_REPLY_TO.''."\n";
	$headers .='Content-Type: text/html; charset=utf-8"'."\n";
	$headers .='Content-Transfer-Encoding: 8bit';
	
	$template=  file_get_contents($_SERVER['DOCUMENT_ROOT']."/html/mail/template_forgot_password.html");
	$parametre = array();
	$parametre['USER_FULLNAME']= $utilisateur->fullname();
	$parametre['NEW_PASSWORD']=$motdepasse;
	
	foreach ($parametre as $key=> $value){
		$template = str_replace('{{ '.$key.' }}', $value, $template);
	}
	
	mail($utilisateur->login, 'Votre nouveau mot de passe LiveSchool', utf8_decode($template), $headers);
}

function envoiMailDemandeInscription($etablissement, $utilisateur){
	$headers ='From: "'.Constants::MAIL_FROM_NAME.'"<'.Constants::MAIL_FROM.'>'."\n";
	$headers .='Reply-To: '.Constants::MAIL_REPLY_TO.''."\n";
	$headers .='Content-Type: text/html; charset=utf-8"'."\n";
	$headers .='Content-Transfer-Encoding: 8bit';
	
	$template=  file_get_contents($_SERVER['DOCUMENT_ROOT']."/html/mail/template_demande_inscription.html");
	$parametre = array();
	$parametre['NOM_ETABLISSEMENT']= $etablissement->nom;
	$parametre['TELEPHONE']=$etablissement->telephone1;
	$parametre['EMAIL']=$utilisateur->login;
	$parametre['NOM']=$utilisateur->nom;
	$parametre['PRENOM']=$utilisateur->prenom;
	$parametre['MOT_DE_PASSE']=$utilisateur->mdp;
	
	foreach ($parametre as $key=> $value){
		$template = str_replace('{{ '.$key.' }}', $value, $template);
	}
	
	mail(Constants::MAIL_DEMANDE_INCRIPTION, 'Nouvelle inscription !', utf8_decode($template), $headers);
	return true;
}

function envoiMailNotificationPost($post, $utilisateur, $listeUtilisateurs){
	foreach ($listeUtilisateurs as $user){
		$headers ='From: "'.Constants::MAIL_FROM_NAME.'"<'.Constants::MAIL_FROM.'>'."\n";
		$headers .='Reply-To: '.Constants::MAIL_REPLY_TO.''."\n";
		$headers .='Content-Type: text/html; charset=utf-8"'."\n";
		$headers .='Content-Transfer-Encoding: 8bit';
		
		$template=  file_get_contents($_SERVER['DOCUMENT_ROOT']."/html/mail/template_post_notification.html");
		$parametre = array();
		$parametre['USER_FULLNAME']= $user->fullname();
		$parametre['CREATEUR']=$utilisateur->fullname();
		$parametre['POST_CONTENU']=$post->contenu;
		
		foreach ($parametre as $key=> $value){
			$template = str_replace('{{ '.$key.' }}', $value, $template);
		}
		mail($user->login, 'Nouveau message !', utf8_decode($template), $headers);
	}
}
