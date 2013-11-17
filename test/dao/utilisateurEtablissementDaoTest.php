<?php

include("../../core/include.php");
include("../../core/constant/constants.php");


//TEST de la classe EtablissementDao

echo "Test Class UtilisateurEtablissementDao.<br>";
$dao= new UtilisateurEtablissementDao();

$utilisateur = new Utilisateur();
$utilisateur->idUser = "0";
$utilisateurDao = new UtilisateurDao();
$utilisateurDao->saveUtilisateur($utilisateur);


$listEtablissementId = new ArrayObject();

$etablissement = new Etablissement();
$etablissement->idEtablissement = "0";
$etablissementDao = new EtablissementDao();
$etablissementDao->saveEtablissement($etablissement);
$listEtablissementId->append($etablissement->idEtablissement);


$etablissement = new Etablissement();
$etablissement->idEtablissement = "1";
$etablissementDao->saveEtablissement($etablissement);
$listEtablissementId->append($etablissement->idEtablissement);

$dao->saveUtilisateurEtablissements($utilisateur, $listEtablissementId);
echo "save ok<br>";

$listUtilisateurId = new ArrayObject();

$utilisateur = new Utilisateur();
$utilisateur->idUser = "1";
$utilisateurDao = new UtilisateurDao();
$utilisateurDao->saveUtilisateur($utilisateur);
$listUtilisateurId->append($utilisateur->idUser);


$utilisateur = new Utilisateur();
$utilisateur->idUser = "2";
$utilisateurDao = new UtilisateurDao();
$utilisateurDao->saveUtilisateur($utilisateur);
$listUtilisateurId->append($utilisateur->idUser);

$etablissement = new Etablissement();
$etablissement->idEtablissement = "2";
$etablissementDao->saveEtablissement($etablissement);

$dao->saveEtablissementUtilisateurs($etablissement, $listUtilisateurId);
echo "save ok<br>";

$utilisateur = new Utilisateur();
$utilisateur->idUser = "0";
$listeEtablissementByUserId = $dao->findEtablissementIdByUtilisateur($utilisateur);
if($listeEtablissementByUserId->count() == 2){
	echo "findEtablissementIdByUtilisateur OK<br>";
}else{
	echo "findEtablissementIdByUtilisateur KO<br>";
}

$dao->deleteUtilisateur($utilisateur);
echo "delete ok<br>";
$listeEtablissementByUserId = $dao->findEtablissementIdByUtilisateur($utilisateur);
if($listeEtablissementByUserId->count() == 0){
	echo "findEtablissementIdByUtilisateur OK<br>";
}else{
	echo "findEtablissementIdByUtilisateur KO<br>";
}

$etablissement = new Etablissement();
$etablissement->idEtablissement = "2";
$etablissementDao->saveEtablissement($etablissement);
$listeUserByEtablissement = $dao->findUtilisateurIdByEtablissement($etablissement);
if($listeUserByEtablissement->count() == 2){
	echo "findUtilisateurIdByEtablissement OK<br>";
}else{
	echo "findUtilisateurIdByEtablissement KO<br>";
}

$dao->deleteEtablissement($etablissement);



$utilisateur = new Utilisateur();
$utilisateur->idUser = "0";
$utilisateurDao->deleteUtilisateur($utilisateur);
$utilisateur = new Utilisateur();
$utilisateur->idUser = "1";
$utilisateurDao->deleteUtilisateur($utilisateur);
$utilisateur = new Utilisateur();
$utilisateur->idUser = "2";
$utilisateurDao->deleteUtilisateur($utilisateur);


$etablissement = new Etablissement();
$etablissement->idEtablissement = "0";
$etablissementDao->deleteEtablissemenr($etablissement);
$etablissement = new Etablissement();
$etablissement->idEtablissement = "1";
$etablissementDao->deleteEtablissemenr($etablissement);
$etablissement = new Etablissement();
$etablissement->idEtablissement = "2";
$etablissementDao->deleteEtablissemenr($etablissement);


echo "TEST OK.<br>";

?>