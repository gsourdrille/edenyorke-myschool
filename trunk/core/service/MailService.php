<?php

interface MailService {
	
	function envoiMailInscription($utilisateur,$token);
	
	function envoiMailConfirmationEnvoiPassword($utilisateur,$motdepasse);
	
	function envoiMailDemandeInscription($etablissement, $utilisateur);
	
	function envoiMailNotificationPost($post, $utilisateur, $listeUtilisateurs);

}

