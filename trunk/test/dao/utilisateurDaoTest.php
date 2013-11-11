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

$listeTypesUtilisateurs = new ArrayObject();
$listeTypesUtilisateurs->append(Type_Utilisateur::DIRECTION);
$listeTypesUtilisateurs->append(Type_Utilisateur::ENSEIGNANT);


$dao->saveUtilisateur($utilisateur);
$dao->saveUtilisateurTypeUtilisateur($utilisateur, $listeTypesUtilisateurs);
echo "save ok<br>";
$utilisateur = $dao->findUtilisateur("loginTest", "mdpTest");
$utilisateur->afficher();
$listeTypesUtilisateurs = $dao->findTypeUtilisateur($utilisateur);
echo "Taile Liste : ".$listeTypesUtilisateurs->count()."<br>";
echo "find ok<br>";
$dao->deleteUtilisateur($utilisateur);
echo "delete ok<br>";
$utilisateur = $dao->findUtilisateur("loginTest", "mdpTest");
echo "find ok<br>";
if($utilisateur == null){
	echo "TEST OK.<br>";
}else{
	echo "TEST KO.<br>";
	$utilisateur->afficher();
}
?>