<?php



 class ClasseDao{
 	
 	public function saveClasse($classe){
 		if($classe != null){
  			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$nom = mysql_real_escape_string($classe->nom);
 			$requete = "INSERT INTO CLASSE (NOM,ID_NIVEAU) VALUES ('$nom', '$classe->idNiveau') ";
 			$result = $baseDao->sendRequest($requete);
 			$requete = "SELECT LAST_INSERT_ID() FROM CLASSE";
 			$result = mysql_insert_id(); 
 			$classe->idClasse = $result;
 			$baseDao->close();
 			return $classe;
 		}
 		
 	}
 	
 	
 	public function updateClasse($classe){
 		if($classe != null){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$nom = mysql_real_escape_string($classe->nom);
 			$requete = "UPDATE CLASSE SET NOM='$nom' WHERE ID_CLASSE=$classe->idClasse";
 			$result  = $baseDao->sendRequest($requete);
 			$baseDao->close();
 			if(!$result){
 				return false;
 			}else{
 				return true;
 			}
 		}
 	}
 	
 	 	
 	public function deleteClasse($classe){
 		if($classe != null){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$requete = "DELETE FROM CLASSE WHERE ID_CLASSE=$classe->idClasse";
 			$baseDao->sendRequest($requete);
 			$baseDao->close();
 		}
 	}
 	
 	public function findClasse($idClasse){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$requete = "SELECT * FROM CLASSE WHERE ID_CLASSE='$idClasse'";
 			$resulat = $baseDao->sendRequest($requete);
 			$row = mysql_fetch_array($resulat, MYSQL_ASSOC);
 			if($row["ID_CLASSE"] == null){
 				return null;
 			}
 			$classe = $this->buildClasse($row);
 			$baseDao->close();
 			return $classe;
 	}
 	
 	public function findClasseByNiveau($idNiveau){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		$requete = "SELECT * FROM CLASSE WHERE ID_NIVEAU='$idNiveau'";
 		$resulat = $baseDao->sendRequest($requete);
 		$listeClasses = new ArrayObject();
 		while($row = mysql_fetch_array($resulat, MYSQL_ASSOC)){
 			$listeClasses->append($this->buildClasse($row));
 		}
 		$baseDao->close();
 		return $listeClasses;
 	}
 	
 	public function findClasseByNomAndNiveau($nom, $idNiveau){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		$requete = "SELECT * FROM CLASSE WHERE NOM='$nom' AND ID_NIVEAU='$idNiveau'";
 		$resulat = $baseDao->sendRequest($requete);
 		$row = mysql_fetch_array($resulat, MYSQL_ASSOC);
 		if($row["ID_CLASSE"] == null){
 			return null;
 		}
 		$classe = $this->buildClasse($row);
 		$baseDao->close();
 		return $classe;
 	}
 	
 	
 	
 	public function buildClasse($row){
  		$classe = new Classe();
 		$classe->idClasse = $row["ID_CLASSE"];
 		$classe->nom = $row["NOM"];
 		$classe->idNiveau = $row["ID_NIVEAU"];
 		return $classe;
 	}
 	
 	
 }