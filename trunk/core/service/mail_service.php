<?php

function envoiMailInscription($to,$token){
	
	 $headers ='From: "'.Constants::MAIL_FROM_NAME.'"<'.Constants::MAIL_FROM.'>'."\n"; 
     $headers .='Reply-To: '.Constants::MAIL_REPLY_TO.''."\n"; 
     $headers .='Content-Type: text/html; charset="iso-8859-1"'."\n"; 
     $headers .='Content-Transfer-Encoding: 8bit'; 
     $message ='<html><head><title>Inscription Myschool</title></head><body>Pour valider votre inscription merci de cliquer sur <a href="'.Constants::MAIL_VALID_URL_REPONSE.$token.'">ce lien</a></body></html>'; 
     mail($to, 'Validation inscription MySchool', $message, $headers);
     
     
     
	
}

