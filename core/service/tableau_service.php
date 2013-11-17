<?php

include("../include.php");


function getTypeUtilisateur($utilisateur){
	$daoUtilisateur = new UtilisateurDao();
	$typeUtilisateur = $daoUtilisateur->findTypeUtilisateur($utilisateur);
	return $typeUtilisateur;
}