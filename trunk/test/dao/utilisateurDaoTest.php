<?php

include("../../core/include.php");
//TEST de la classe UtilisateurDao
error_reporting(E_ALL);
$dao= new UtilisateurDao();
echo "OK";
$utilisateur = new Utilisateur();
echo "OK";
$utilisateur->idUser = "0";
$utilisateur->nom = "nomTest";
$utilisateur->prenom="prenomTest";
$utilisateur->login="loginTest";
$utilisateur->mdp = "mdpTest";
echo "before save";
$dao->saveUtilisateur($utilisateur);
echo "after Save";
$utilisateur2 = $dao->findUtilisateur("loginTest", "mdpTest");
$utilisateur2->toString();

$dao->deleteUtilisateur($utilisateur2);

?>