<?php

include("../../core/include.php");
include("../../core/constant/constants.php");


//TEST de la classe UtilisateurDao

echo "Test Class UtilisateurDao.<br>";
$dao= new UtilisateurDao();
$utilisateur = new Utilisateur();
$utilisateur->idUser = "0";
$utilisateur->nom = "nomTest";
$utilisateur->prenom="prenomTest";
$utilisateur->login="loginTest";
$utilisateur->mdp = "mdpTest";

$typesUtilisateur = array(Type_Utilisateur::DIRECTION,Type_Utilisateur::ENSEIGNANT);

$utilisateur->typesUtilisateur = $typesUtilisateur[];
$utilisateur->afficher();
$dao->saveUtilisateur($utilisateur);
//$utilisateur = $dao->findUtilisateur("loginTest", "mdpTest");
//$dao->deleteUtilisateur($utilisateur);
//$utilisateur = $dao->findUtilisateur("loginTest", "mdpTest");
if($utilisateur == null){
	echo "TEST OK.<br>";
}
?>