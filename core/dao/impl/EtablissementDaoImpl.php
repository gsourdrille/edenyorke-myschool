<?php

include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/impl/BaseDaoImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/bean/Etablissement.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/EtablissementDao.php");

class EtablissementDaoImpl extends BaseDaoImpl implements EtablissementDao{
	
	
	public function saveEtablissement($etablissement){
		if($etablissement != null){
			$this->connect();
			
			$nom = $this->escapeString($etablissement->nom);
			$adresse = $this->escapeString($etablissement->adresse);
			$ville = $this->escapeString($etablissement->ville);
			
			$requete = "INSERT INTO ETABLISSEMENT (NOM,ADRESSE,CODE_POSTAL,VILLE,TELEPHONE_1,TELEPHONE_2,FAX)
			VALUES ('$nom', '$etablissement->adresse', '$adresse', '$etablissement->ville', '$ville', '$etablissement->telephone2','$etablissement->fax') ";
			$result = $this->sendRequest($requete);
			$idEtablissement= $this->lastInsertId();
			$etablissement->idEtablissement = $idEtablissement;
			$this->close();
			return $etablissement;
		}
	}
	
	public function updateEtablissement($etablissement){
		if($etablissement != null){
			$this->connect();
			
			$nom = $this->escapeString($etablissement->nom);
			$adresse = $this->escapeString($etablissement->adresse);
			$ville = $this->escapeString($etablissement->ville);
			
			$requete = "UPDATE ETABLISSEMENT SET NOM='$nom', ADRESSE='$adresse', CODE_POSTAL='$etablissement->codePostal',
			VILLE='$ville',TELEPHONE_1='$etablissement->telephone1', TELEPHONE_2='$etablissement->telephone2',FAX='$etablissement->fax' 
			WHERE ID_ETABLISSEMENT=$etablissement->idEtablissement";
			
			$result = $this->sendRequest($requete);
			$this->close();
			if(!$result){
				return false;
			}else{
				return true;
			}
		}
		
	}
	
	public function setImagePrincipaleToEtablissement($idEtablissement, $imageName){
		if($idEtablissement != null){
			$this->connect();
			if(StringUtils::isEmpty($imageName)){
				$requete = "UPDATE ETABLISSEMENT SET IMAGE_PRINCIPALE=null
				WHERE ID_ETABLISSEMENT=$idEtablissement";
			}else{
				$nomImage = $this->escapeString($imageName);
				$requete = "UPDATE ETABLISSEMENT SET IMAGE_PRINCIPALE='$imageName'
				WHERE ID_ETABLISSEMENT=$idEtablissement";
			}
			$result = $this->sendRequest($requete);
			$this->close();
			if(!$result){
				return false;
			}else{
				return true;
			}
		}
	
	}
	
	public function setImageFondToEtablissement($idEtablissement, $imageName){
		if($idEtablissement != null){
			$this->connect();
			if(StringUtils::isEmpty($imageName)){
				$requete = "UPDATE ETABLISSEMENT SET IMAGE_FOND=null  WHERE ID_ETABLISSEMENT=$idEtablissement";
			}else{
				$nomImage = $this->escapeString($imageName);
				$requete = "UPDATE ETABLISSEMENT SET IMAGE_FOND='$nomImage' WHERE ID_ETABLISSEMENT=$idEtablissement";
			}
			$result = $this->sendRequest($requete);
			$this->close();
			if(!$result){
				return false;
			}else{
				return true;
			}
		}
	
	}
	
	public function deleteEtablissemenr($etablissement){
		if($etablissement != null){
			$this->connect();
			$requete = "DELETE FROM ETABLISSEMENT WHERE ID_ETABLISSEMENT=$etablissement->idEtablissement";
			$this->sendRequest($requete);
			$this->close();
		}
	}
	
	public function findEtablissement($idEtablissement){
		$this->connect();
		$requete = "SELECT * FROM ETABLISSEMENT WHERE ID_ETABLISSEMENT='$idEtablissement'";
		$resulat = $this->sendRequest($requete);
		$row = mysqli_fetch_array($resulat, MYSQL_ASSOC);
		if($row["ID_ETABLISSEMENT"] == null){
			return null;
		}
		$etablissement = $this->buildEtablissement($row);
		$this->close();
		return $etablissement;
	}
	
	public function getEtablissementsFromUser($idUser){
		$this->connect();
		$requete = "SELECT * FROM ETABLISSEMENT WHERE ID_ETABLISSEMENT IN (SELECT ID_ETABLISSEMENT FROM UTILISATEUR_ETABLISSEMENT WHERE ID_USER ='$idUser')";
		$resulat = $this->sendRequest($requete);
		$listeEtalissement = new ArrayObject();
 		while($row = mysqli_fetch_array($resulat)){
 			$listeEtalissement->append($this->buildEtablissement($row));  
 		}
 		$this->close();
		return $listeEtalissement;
	}
	
	public function buildEtablissement($row){
		$etablissement = new Etablissement();
		$etablissement->idEtablissement = $row["ID_ETABLISSEMENT"];
		$etablissement->nom = $row["NOM"];
		$etablissement->adresse = $row["ADRESSE"];
		$etablissement->codePostal = $row["CODE_POSTAL"];
		$etablissement->ville = $row["VILLE"];
		$etablissement->telephone1 = $row["TELEPHONE_1"];
		$etablissement->telephone2 = $row["TELEPHONE_2"];
		$etablissement->fax = $row["FAX"];
		$etablissement->imagePrincipale = $row["IMAGE_PRINCIPALE"];
		$etablissement->imageFond = $row["IMAGE_FOND"];
		return $etablissement;
	}
	
	
}

?>