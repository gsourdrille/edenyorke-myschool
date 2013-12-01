<?php



 class NiveauDao{
 	
 	public function saveNiveau($niveau){
 		if($niveau != null){
  			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$nom = $baseDao->escapeString($niveau->nom);
 			$requete = "INSERT INTO NIVEAU (NOM,ID_ETABLISSEMENT) VALUES ('$nom', '$niveau->idEtablissement') ";
 			$result = $baseDao->sendRequest($requete);
 			$result = $baseDao->lastInsertId();
 			$niveau->idNiveau = $idNiveau;
 			$baseDao->close();
 			return $niveau;
 		}
 		
 	}
 	
 	
 	public function updateNiveau($niveau){
 		if($niveau != null){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$nom = $baseDao->escapeString($niveau->nom);
 			$requete = "UPDATE NIVEAU SET NOM='$nom' WHERE ID_NIVEAU=$niveau->idNiveau";
 			$result  = $baseDao->sendRequest($requete);
 			$baseDao->close();
 			if(!$result){
 				return false;
 			}else{
 				return true;
 			}
 		}
 	}
 	
 	 	
 	public function deleteNiveau($idNiveau){
 		if($idNiveau != null){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$requete = "DELETE FROM NIVEAU WHERE ID_NIVEAU=$idNiveau";
 			echo $requete;
 			$baseDao->sendRequest($requete);
 			$baseDao->close();
 		}
 	}
 	
 	public function findNiveau($idNiveau){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$requete = "SELECT * FROM NIVEAU WHERE ID_NIVEAU='$idNiveau'";
 			$resulat = $baseDao->sendRequest($requete);
 			$row = mysqli_fetch_array($resulat);
 			if($row["ID_NIVEAU"] == null){
 				return null;
 			}
 			$niveau = $this->buildNiveau($row);
 			$baseDao->close();
 			return $niveau;
 	}
 	
 	public function findNiveauxByEtablissement($idEtablissement){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		$requete = "SELECT * FROM NIVEAU WHERE ID_ETABLISSEMENT='$idEtablissement'";
 		$resulat = $baseDao->sendRequest($requete);
 		$listeNiveaux = new ArrayObject();
 		while($row = mysqli_fetch_array($resulat)){
 			$listeNiveaux->append($this->buildNiveau($row));
 		}
 		$baseDao->close();
 		return $listeNiveaux;
 	}
 	
 	public function findNiveauByNomAndEtablissement($nom, $idEtablissement){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		$requete = "SELECT * FROM NIVEAU WHERE NOM='$nom' AND ID_ETABLISSEMENT='$idEtablissement'";
 		$resulat = $baseDao->sendRequest($requete);
 		$row = mysqli_fetch_array($resulat);
 		if($row["ID_NIVEAU"] == null){
 			return null;
 		}
 		$niveau = $this->buildNiveau($row);
 		$baseDao->close();
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