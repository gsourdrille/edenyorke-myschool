<?php

include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/impl/BaseDaoImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/bean/Classe.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/ClasseDao.php");

 class ClasseDaoImpl extends  BaseDaoImpl implements ClasseDao{
 	
 	public function saveClasse($classe){
 		if($classe != null){
 			$this->connect();
 			$nom = $this->escapeString($classe->nom);
 			$requete = "INSERT INTO CLASSE (NOM,ID_NIVEAU,CODE_ELEVE,CODE_ENSEIGNANT) VALUES ('$nom', '$classe->idNiveau', '$classe->codeEleve', '$classe->codeEnseignant') ";
 			$result = $this->sendRequest($requete);
 			$idClasse = $this->lastInsertId();
 			$classe->idClasse = $idClasse;
 			$this->close();
 			return $classe;
 		}
 		
 	}
 	
 	
 	public function updateClasse($classe){
 		if($classe != null){
 			$this->connect();
 			$nom = $this->escapeString($classe->nom);
 			$requete = "UPDATE CLASSE SET NOM='$nom' WHERE ID_CLASSE=$classe->idClasse";
 			$result  = $this->sendRequest($requete);
 			$this->close();
 			if(!$result){
 				return false;
 			}else{
 				return true;
 			}
 		}
 	}
 	
 	 	
 	public function deleteClasse($idClasse){
 		if($idClasse != null){
 			$this->connect();
 			$requete = "DELETE FROM CLASSE WHERE ID_CLASSE=$idClasse";
 			$this->sendRequest($requete);
 			$this->close();
 		}
 	}
 	
 	public function findClasse($idClasse){
 			$this->connect();
 			$requete = "SELECT * FROM CLASSE WHERE ID_CLASSE='$idClasse'";
 			$resulat = $this->sendRequest($requete);
 			$row = mysqli_fetch_assoc($resulat);
 			if($row["ID_CLASSE"] == null){
 				return null;
 			}
 			$classe = $this->buildClasse($row);
 			$this->close();
 			return $classe;
 	}
 	
 	public function findClasseByNiveau($idNiveau){
 		$this->connect();
 		$requete = "SELECT * FROM CLASSE WHERE ID_NIVEAU='$idNiveau'";
 		$resulat = $this->sendRequest($requete);
 		$listeClasses = new ArrayObject();
 		while($row = mysqli_fetch_assoc($resulat)){
 			$listeClasses->append($this->buildClasse($row));
 		}
 		$this->close();
 		return $listeClasses;
 	}
 	
 	public function findClasseByNomAndNiveau($nom, $idNiveau){
 		$this->connect();
 		$requete = "SELECT * FROM CLASSE WHERE NOM='$nom' AND ID_NIVEAU='$idNiveau'";
 		$resulat = $this->sendRequest($requete);
 		$row = mysqli_fetch_assoc($resulat);
 		if($row["ID_CLASSE"] == null){
 			return null;
 		}
 		$classe = $this->buildClasse($row);
 		$this->close();
 		return $classe;
 	}
 	
 	public function getClassesByUtlisateur($idUser){
 		$this->connect();
 		$requete = "SELECT * FROM UTILISATEUR_CLASSE WHERE ID_USER='$idUser'";
 		$resulat = $this->sendRequest($requete);
 		$listeClassesByUtilisateur = new ArrayObject();
 		while($row = mysqli_fetch_assoc($resulat)){
 			$idClasse = $row['ID_CLASSE'];
 			$requete = "SELECT * FROM CLASSE WHERE ID_CLASSE =$idClasse";
 			$resulatClasse = $this->sendRequest($requete);
 			$rowClasse = mysqli_fetch_assoc($resulatClasse);
 			$listeClassesByUtilisateur->append($this->buildClasse($rowClasse));
 		}
 		$this->close();
 		return $listeClassesByUtilisateur;
 	}
 	
 	public function addClassesToUser($idUser, $listeIdClasses){
 		$this->connect();
 		$requete = "DELETE FROM UTILISATEUR_CLASSE WHERE ID_USER='$idUser'";
 		$resulat = $this->sendRequest($requete);
 		if($listeIdClasses != null){
	 		foreach ($listeIdClasses as $idClasse){
	 			$requete = "INSERT INTO UTILISATEUR_CLASSE (ID_USER,ID_CLASSE) VALUES ('$idUser', '$idClasse') ";
	 			$resulat = $this->sendRequest($requete);
	 		}
 		}
 		$this->close();
 	}
 	
 	public function deleteClassesToUser($idUser, $listeIdClasses){
 		$this->connect();
 		if($listeIdClasses != null){
 			foreach ($listeIdClasses as $idClasse){
 				$requete = "DELETE FROM UTILISATEUR_CLASSE WHERE ID_USER='$idUser' AND ID_CLASSE='$idClasse'";
 				$resulat = $this->sendRequest($requete);
 			}
 		}
 		$this->close();
 	}
 	
 	public function addClasseToUser($idUser, $idClasse){
 		$this->connect();
 		if($idClasse != null){
 			$requete = "INSERT INTO UTILISATEUR_CLASSE (ID_USER,ID_CLASSE) VALUES ('$idUser', '$idClasse') ";
 			$resulat = $this->sendRequest($requete);
 		}
 		$this->close();
 	}

 	public function deleteClasseToUtilisateurAndEtablissement($idEtablissement, $idUser){
 		$this->connect();
 		$requete = "DELETE FROM UTILISATEUR_CLASSE WHERE ID_USER = $idUser AND ID_CLASSE IN (SELECT ID_CLASSE FROM CLASSE WHERE ID_NIVEAU IN (SELECT ID_NIVEAU FROM NIVEAU WHERE ID_ETABLISSEMENT = $idEtablissement))";
 		$resulat = $this->sendRequest($requete);
 		$this->close();
 	}
 	public function isUniqueClasseCode($code){
 		$this->connect();
 		$requete = "SELECT COUNT(*) FROM CLASSE WHERE CODE_ELEVE='$code' OR CODE_ENSEIGNANT = '$code'";
 		$resulat = $this->sendRequest($requete); 
 		$result = $resulat->fetch_row();
 		$this->close();
 		
 		if($result[0] == 0){
 			return true;
 		}
 		return false;
 	}
 	
 	public function findClasseByCode($code){
 		$this->connect();
 		$requete = "SELECT * FROM CLASSE WHERE CODE_ELEVE='$code' OR CODE_ENSEIGNANT = '$code'";
 		$resulat = $this->sendRequest($requete);
 		$row = mysqli_fetch_assoc($resulat);
 		if($row["ID_CLASSE"] == null){
 			return null;
 		}
 		$classe = $this->buildClasse($row);
 		$this->close();
 		return $classe;
 	}
 	
 	
 	public function findClasseByEtablissement($idEtablissement){
 		$this->connect();
 		$requete = "SELECT * FROM CLASSE WHERE ID_NIVEAU IN (SELECT ID_NIVEAU FROM NIVEAU WHERE ID_ETABLISSEMENT='$idEtablissement')";
 		$resulat = $this->sendRequest($requete);
 		$listeClasses = new ArrayObject();
 		while($row = mysqli_fetch_assoc($resulat)){
 			$listeClasses->append($this->buildClasse($row));
 		}
 		$this->close();
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