<?php



 interface  NiveauDao extends  BaseDao{
 	
 	public function saveNiveau($niveau);
 	
 	public function updateNiveau($niveau);
 	 	
 	public function deleteNiveau($idNiveau);
 	
 	public function findNiveau($idNiveau);
 	
 	public function findNiveauxByEtablissement($idEtablissement);
 	
 	public function findNiveauByNomAndEtablissement($nom, $idEtablissement);
 	
 	public function buildNiveau($row);
 	
 	
 }