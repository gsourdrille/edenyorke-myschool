<?php

function envoiMailInscription($to,$token){
	
	 $headers ='From: "nom"<gsourdrille@gmail.com>'."\n"; 
     $headers .='Reply-To: gsourdrille@gmail.com'."\n"; 
     $headers .='Content-Type: text/html; charset="iso-8859-1"'."\n"; 
     $headers .='Content-Transfer-Encoding: 8bit'; 
     $message ='<html><head><title>Un titre ici</title></head><body>Un message de test</body></html>'; 
     mail($to, 'Sujet', $message, $headers);
	
}