<?php

class EtablissementDao{
	
	
	public function saveEtablissement($etablissement){
		if($etablissement != null){
			$baseDao = new BaseDao();
			$baseDao->connect();
			$requete = "INSERT INTO ETABLISSEMENT (ID_ETABLISSEMENT,NOM,ADRESSE,CODE_POSTAL,VILLE,TELEPHONE_1,TELEPHONE_2,FAX)
			VALUES ('$etablissement->idEtablissement',  '$etablissement->nom', '$etablissement->adresse', '$etablissement->codePostal', '$etablissement->ville', '$etablissement->telephone1', '$etablissement->telephone2','$etablissement->fax') ";
			$result = $baseDao->sendRequest($requete);
			$baseDao->close();
		}
	}
	
	public function updateEtablissement($etablissement){
		if($etablissement != null){
			$baseDao = new BaseDao();
			$baseDao->connect();
			
			$nom = mysql_real_escape_string($etablissement->nom);
			$adresse = mysql_real_escape_string($etablissement->adresse);
			$ville = mysql_real_escape_string($etablissement->ville);
			
			$requete = "UPDATE ETABLISSEMENT SET NOM='$nom', ADRESSE='$adresse', CODE_POSTAL='$etablissement->codePostal',VILLE='$ville',TELEPHONE_1='$etablissement->telephone1', TELEPHONE_2='$etablissement->telephone2',FAX='$etablissement->fax'
			WHERE ID_ETABLISSEMENT=$etablissement->idEtablissement";
			
			$result = $baseDao->sendRequest($requete);
			echo $requete;
			$baseDao->close();
			if(!$result){
				return false;
			}else{
				return true;
			}
		}
		
	}
	
	public function deleteEtablissemenr($etablissement){
		if($etablissement != null){
			$baseDao = new BaseDao();
			$baseDao->connect();
			$requete = "DELETE FROM ETABLISSEMENT WHERE ID_ETABLISSEMENT=$etablissement->idEtablissement";
			$baseDao->sendRequest($requete);
			$baseDao->close();
		}
	}
	
	public function findEtablissement($idEtablissement){
		$baseDao = new BaseDao();
		$baseDao->connect();
		$requete = "SELECT * FROM ETABLISSEMENT WHERE ID_ETABLISSEMENT='$idEtablissement'";
		$resulat = $baseDao->sendRequest($requete);
		$row = mysql_fetch_array($resulat, MYSQL_ASSOC);
		if($row["ID_ETABLISSEMENT"] == null){
			return null;
		}
		$etablissement = $this->buildEtablissement($row);
		$baseDao->close();
		return $etablissement;
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
		return $etablissement;
	}
	
	
}

?>