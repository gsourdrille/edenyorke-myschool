<?php

class UtilisateurEtablissementDao{
	
	
	public function findEtablissementIdByUtilisateur($utilisateur){
		
		if($utilisateur != null){
			$baseDao = new BaseDao();
			$baseDao->connect();
			$requete = "SELECT * FROM UTILISATEUR_ETABLISSEMENT WHERE ID_USER='$utilisateur->idUser'";
			$resulat = $baseDao->sendRequest($requete);
			$listeEtablissementId = new ArrayObject();
			while($row = mysql_fetch_array($resulat, MYSQL_ASSOC)){
				$listeEtablissementId->append($row["ID_ETABLISSEMENT"]);
			}
			$baseDao->close();
			return $listeEtablissementId;
		}
	}
	
	public function findUtilisateurIdByEtablissement($etablissement){
	
		if($etablissement != null){
			$baseDao = new BaseDao();
			$baseDao->connect();
			$requete = "SELECT * FROM UTILISATEUR_ETABLISSEMENT WHERE ID_ETABLISSEMENT='$etablissement->idEtablissement'";
			$resulat = $baseDao->sendRequest($requete);
			$listeUtilisateurId = new ArrayObject();
			while($row = mysql_fetch_array($resulat, MYSQL_ASSOC)){
				$listeUtilisateurId->append($row["ID_USER"]);
			}
			$baseDao->close();
			return $listeUtilisateurId;
		}
	}
	
	public function saveUtilisateurEtablissements($utilisateur, $listeEtablissementsId){
		if($utilisateur != null && $listeEtablissementsId != null){
			$baseDao = new BaseDao();
			$baseDao->connect();
			//Supression des anciennes relations
			$requete = "DELETE FROM UTILISATEUR_ETABLISSEMENT WHERE ID_USER=$utilisateur->idUser";
			echo $requete."<br>";
			$result = $baseDao->sendRequest($requete);
			foreach ($listeEtablissementsId as $etablissementId) {
				$requete = "INSERT INTO UTILISATEUR_ETABLISSEMENT (ID_USER,ID_ETABLISSEMENT)
				VALUES ('$utilisateur->idUser', $etablissementId) ";
				echo $requete."<br>";
				$result = $baseDao->sendRequest($requete);
			}
			$baseDao->close();
		}
	}
	
	public function saveEtablissementUtilisateurs($etablissement, $listeUtilisateurId){
		if($etablissement != null && $listeUtilisateurId != null){
			$baseDao = new BaseDao();
			$baseDao->connect();
			//Supression des anciennes relations
			$requete = "DELETE FROM UTILISATEUR_ETABLISSEMENT WHERE ID_ETABLISSEMENT=$etablissement->idEtablissement";
			$result = $baseDao->sendRequest($requete);
			foreach ($listeUtilisateurId as $utilisateurId) {
				$requete = "INSERT INTO UTILISATEUR_ETABLISSEMENT (ID_USER,ID_ETABLISSEMENT)
				VALUES ('$utilisateurId', $etablissement->idEtablissement) ";
				$result = $baseDao->sendRequest($requete);
			}
			$baseDao->close();
		}
	}
	
	public function deleteEtablissement($etablissement){
		if($etablissement != null){
			$baseDao = new BaseDao();
			$baseDao->connect();
			//Supression des anciennes relations
			$requete = "DELETE FROM UTILISATEUR_ETABLISSEMENT WHERE ID_ETABLISSEMENT=$etablissement->idEtablissement";
			$result = $baseDao->sendRequest($requete);
			$baseDao->close();
		}
	}
	
	public function deleteUtilisateur($utilisateur){
		if($utilisateur != null){
			$baseDao = new BaseDao();
			$baseDao->connect();
			//Supression des anciennes relations
			$requete = "DELETE FROM UTILISATEUR_ETABLISSEMENT WHERE ID_USER=$utilisateur->idUser";
			$result = $baseDao->sendRequest($requete);
			$baseDao->close();
		}
	}
}


?>