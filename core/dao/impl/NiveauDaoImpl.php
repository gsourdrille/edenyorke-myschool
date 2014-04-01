<?php

include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/impl/BaseDaoImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/bean/Niveau.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/NiveauDao.php");

 class NiveauDaoImpl extends  BaseDaoImpl implements NiveauDao{
 	
 	public function saveNiveau($niveau){
 		if($niveau != null){
 			$this->connect();
 			$nom = $this->escapeString($niveau->nom);
 			$idNiveau = uniqid('n');
 			$requete = "INSERT INTO NIVEAU (ID_NIVEAU,NOM,ID_ETABLISSEMENT) VALUES ('$idNiveau', '$nom', '$niveau->idEtablissement') ";
 			$result = $this->sendRequest($requete);
 			$niveau->idNiveau = $idNiveau;
 			$this->close();
 			return $niveau;
 		}
 		
 	}
 	
 	
 	public function updateNiveau($niveau){
 		if($niveau != null){
 			$this->connect();
 			$nom = $this->escapeString($niveau->nom);
 			$requete = "UPDATE NIVEAU SET NOM='$nom' WHERE ID_NIVEAU='$niveau->idNiveau'";
 			$result  = $this->sendRequest($requete);
 			$this->close();
 			if(!$result){
 				return false;
 			}else{
 				return true;
 			}
 		}
 	}
 	
 	 	
 	public function deleteNiveau($idNiveau){
 		if($idNiveau != null){
 			$this->connect();
 			$requete = "DELETE FROM NIVEAU WHERE ID_NIVEAU='$idNiveau'";
 			$this->sendRequest($requete);
 			$this->close();
 		}
 	}
 	
 	public function findNiveau($idNiveau){
 			$this->connect();
 			$requete = "SELECT * FROM NIVEAU WHERE ID_NIVEAU='$idNiveau'";
 			$resulat = $this->sendRequest($requete);
 			$row = mysqli_fetch_array($resulat);
 			if($row["ID_NIVEAU"] == null){
 				return null;
 			}
 			$niveau = $this->buildNiveau($row);
 			$this->close();
 			return $niveau;
 	}
 	
 	public function findNiveauxByEtablissement($idEtablissement){
 		$this->connect();
 		$requete = "SELECT * FROM NIVEAU WHERE ID_ETABLISSEMENT='$idEtablissement'";
 		$resulat = $this->sendRequest($requete);
 		$listeNiveaux = new ArrayObject();
 		while($row = mysqli_fetch_array($resulat)){
 			$listeNiveaux->append($this->buildNiveau($row));
 		}
 		$this->close();
 		return $listeNiveaux;
 	}
 	
 	public function findNiveauByNomAndEtablissement($nom, $idEtablissement){
 		$this->connect();
 		$requete = "SELECT * FROM NIVEAU WHERE NOM='$nom' AND ID_ETABLISSEMENT='$idEtablissement'";
 		$resulat = $this->sendRequest($requete);
 		$row = mysqli_fetch_array($resulat);
 		if($row["ID_NIVEAU"] == null){
 			return null;
 		}
 		$niveau = $this->buildNiveau($row);
 		$this->close();
 		return $niveau;
 	}
 	
 	
 	
 	public function buildNiveau($row){
  		$niveau = new Niveau();
 		$niveau->idNiveau = $row["ID_NIVEAU"];
 		$niveau->nom = $row["NOM"];
 		$niveau->idEtablissement = $row["ID_ETABLISSEMENT"];
 		return $niveau;
 	}
 	
 	
 }