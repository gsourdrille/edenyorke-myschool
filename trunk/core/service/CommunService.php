<?php

interface CommunService {

	function getTypeUtilisateur($utilisateur);
	
	function getEtablissement($etablissementId);
	
	function getEtablissementFromUser($idUser);
	
	function getTypeUtilisateurLibelle($typeUtilisateur);
	
	function getFirstEtablissement($utilisateur);

}