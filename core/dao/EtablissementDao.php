<?php

interface EtablissementDao extends BaseDao{
	
	
	public function saveEtablissement($etablissement);
	
	public function updateEtablissement($etablissement);
	
	public function setImagePrincipaleToEtablissement($idEtablissement, $imageName);
	
	public function setImageFondToEtablissement($idEtablissement, $imageName);
	
	public function deleteEtablissemenr($etablissement);
	
	public function findEtablissement($idEtablissement);
	
	public function getEtablissementsFromUser($idUser);
	
	public function buildEtablissement($row);
	
}

?>