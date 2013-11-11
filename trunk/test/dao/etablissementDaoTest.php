<?php

include("../../core/include.php");
include("../../core/constant/constants.php");


//TEST de la classe EtablissementDao

echo "Test Class EtablissementDao.<br>";
$dao= new EtablissementDao();
$etablissement = new Etablissement();
$etablissement->idEtablissement = "0";
$etablissement->nom = "nomTest";
$etablissement->adresse="adresseTest";
$etablissement->codePostal="codePostalTest";
$etablissement->ville = "villeTest";
$etablissement->telephone1 = "tel1Test";
$etablissement->telephone2 = "tel2test";
$etablissement->fax = "faxTest";

$dao->saveEtablissement($etablissement);
echo "save ok<br>";
$etablissement = $dao->findEtablissement("0");
$etablissement->afficher();
echo "find ok<br>";
$dao->deleteEtablissemenr($etablissement);
echo "delete ok<br>";
$etablissement = $dao->findEtablissement("0");
echo "find ok<br>";
if($etablissement == null){
	echo "TEST OK.<br>";
}else{
	echo "TEST KO.<br>";
	$etablissement->afficher();
}
?>