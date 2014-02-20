<?php

 class ClasseDao{
 	
 	public function saveClasse($classe){
 		if($classe != null){
  			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$nom = $baseDao->escapeString($classe->nom);
 			$requete = "INSERT INTO CLASSE (NOM,ID_NIVEAU,CODE_ELEVE,CODE_ENSEIGNANT) VALUES ('$nom', '$classe->idNiveau', '$classe->codeEleve', '$classe->codeEnseignant') ";
 			$result = $baseDao->sendRequest($requete);
 			$idClasse = $baseDao->lastInsertId();
 			$classe->idClasse = $idClasse;
 			$baseDao->close();
 			return $classe;
 		}
 		
 	}
 	
 	
 	public function updateClasse($classe){
 		if($classe != null){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$nom = $baseDao->escapeString($classe->nom);
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
 	
 	 	
 	public function deleteClasse($idClasse){
 		if($idClasse != null){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$requete = "DELETE FROM CLASSE WHERE ID_CLASSE=$idClasse";
 			$baseDao->sendRequest($requete);
 			$baseDao->close();
 		}
 	}
 	
 	public function findClasse($idClasse){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$requete = "SELECT * FROM CLASSE WHERE ID_CLASSE='$idClasse'";
 			$resulat = $baseDao->sendRequest($requete);
 			$row = mysqli_fetch_assoc($resulat);
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
 		while($row = mysqli_fetch_assoc($resulat)){
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
 		$row = mysqli_fetch_assoc($resulat);
 		if($row["ID_CLASSE"] == null){
 			return null;
 		}
 		$classe = $this->buildClasse($row);
 		$baseDao->close();
 		return $classe;
 	}
 	
 	public function getClassesByUtlisateur($idUser){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		$requete = "SELECT * FROM UTILISATEUR_CLASSE WHERE ID_USER='$idUser'";
 		$resulat = $baseDao->sendRequest($requete);
 		$listeClassesByUtilisateur = new ArrayObject();
 		while($row = mysqli_fetch_assoc($resulat)){
 			$idClasse = $row['ID_CLASSE'];
 			$requete = "SELECT * FROM CLASSE WHERE ID_CLASSE =$idClasse";
 			$resulatClasse = $baseDao->sendRequest($requete);
 			$rowClasse = mysqli_fetch_assoc($resulatClasse);
 			$listeClassesByUtilisateur->append($this->buildClasse($rowClasse));
 		}
 		$baseDao->close();
 		return $listeClassesByUtilisateur;
 	}
 	
 	public function addClassesToUser($idUser, $listeIdClasses){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		$requete = "DELETE FROM UTILISATEUR_CLASSE WHERE ID_USER='$idUser'";
 		$resulat = $baseDao->sendRequest($requete);
 		if($listeIdClasses != null){
	 		foreach ($listeIdClasses as $idClasse){
	 			$requete = "INSERT INTO UTILISATEUR_CLASSE (ID_USER,ID_CLASSE) VALUES ('$idUser', '$idClasse') ";
	 			$resulat = $baseDao->sendRequest($requete);
	 		}
 		}
 		$baseDao->close();
 	}
 	
 	public function deleteClassesToUser($idUser, $listeIdClasses){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		if($listeIdClasses != null){
 			foreach ($listeIdClasses as $idClasse){
 				$requete = "DELETE FROM UTILISATEUR_CLASSE WHERE ID_USER='$idUser' AND ID_CLASSE='$idClasse'";
 				$resulat = $baseDao->sendRequest($requete);
 			}
 		}
 		$baseDao->close();
 	}
 	
 	public function addClasseToUser($idUser, $idClasse){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		if($idClasse != null){
 			$requete = "INSERT INTO UTILISATEUR_CLASSE (ID_USER,ID_CLASSE) VALUES ('$idUser', '$idClasse') ";
 			$resulat = $baseDao->sendRequest($requete);
 		}
 		$baseDao->close();
 	}

 	
 	public function isUniqueClasseCode($code){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		$requete = "SELECT COUNT(*) FROM CLASSE WHERE CODE_ELEVE='$code' OR CODE_ENSEIGNANT = '$code'";
 		$resulat = $baseDao->sendRequest($requete); 
 		$result = $resulat->fetch_row();
 		$baseDao->close();
 		
 		if($result[0] == 0){
 			return true;
 		}
 		return false;
 	}
 	
 	public function findClasseByCode($code){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		$requete = "SELECT * FROM CLASSE WHERE CODE_ELEVE='$code' OR CODE_ENSEIGNANT = '$code'";
 		$resulat = $baseDao->sendRequest($requete);
 		$row = mysqli_fetch_assoc($resulat);
 		if($row["ID_CLASSE"] == null){
 			return null;
 		}
 		$classe = $this->buildClasse($row);
 		$baseDao->close();
 		return $classe;
 	}
 	
 	
 	public function findClasseByEtablissement($idEtablissement){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		$requete = "SELECT * FROM CLASSE WHERE ID_NIVEAU IN (SELECT ID_NIVEAU FROM NIVEAU WHERE ID_ETABLISSEMENT='$idEtablissement')";
 		$resulat = $baseDao->sendRequest($requete);
 		$listeClasses = new ArrayObject();
 		while($row = mysqli_fetch_assoc($resulat)){
 			$listeClasses->append($this->buildClasse($row));
 		}
 		$baseDao->close();
 		return $listeClasses;
 	}
 	
 	
 	
 	public function buildClasse($row){
  		$classe = new Classe();
 		$classe->idClasse = $row["ID_CLASSE"];
 		$classe->nom = $row["NOM"];
 		$classe->idNiveau = $row["ID_NIVEAU"];
 		$classe->codeEleve = $row["CODE_ELEVE"];
 		$classe->codeEnseignant = $row["CODE_ENSEIGNANT"];
 		return $classe;
 	}
 	
 	
 }