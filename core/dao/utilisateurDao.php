<?php


include ("baseDao.php");
 class UtilisateurDao{
 	
 	public function saveUtilisateur($utilisateur){
 		if($utilisateur != null){
  			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$requete = "INSERT INTO UTILISATEUR (ID_USER,NOM,PRENOM,LOGIN,MOT_DE_PASSE) 
 						VALUES ('$utilisateur->idUser', '$utilisateur->nom', '$utilisateur->prenom', '$utilisateur->login', '$utilisateur->mdp') ";
 			$result = $baseDao->sendRequest($requete);
 			echo "test1";
 			echo "USER : ".$utilisateur->typesUtilisateurs[0];
 			if(sizeof($utilisateur->typesUtilisateurs)>0){
 				echo "test2";
 				$requete = "DELETE FROM UTILISATEUR_TYPE_UTILISATEUR WHERE ID_USER=$utilisateur->idUser";
 				$baseDao->sendRequest($requete);
 				foreach ($utilisateur->typesUtilisateurs as $typeUtilisateur) {
 					$requete = "INSERT INTO UTILISATEUR_TYPE_UTILISATEUR (ID_USER,ID_TYPE_UTILISATEUR)
 					VALUES ('$utilisateur->idUser', $typeUtilisateur) ";
 					$result = $baseDao->sendRequest($requete);
 				}
 			}
 			$baseDao->close();
 		}
 		
 	}
 	
 
 	
 	public function updateUtilisateur($utilisateur){
 		if($utilisateur != null){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$requete = "UPDATE UTILISATEUR SET NOM=$utilisateur->nom, PRENOM=$utilisateur->prenom, LOGIN=$utilisateur->login,MOT_DE_PASSE=$utilisateur->mdp
 						WHERE ID_USER=$utilisateur->idUser";
 			$baseDao->sendRequest($requete);
 			$baseDao->close();
 		}
 	}
 	
 	public function deleteUtilisateur($utilisateur){
 		if($utilisateur != null){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$requete = "DELETE FROM UTILISATEUR WHERE ID_USER=$utilisateur->idUser";
 			$baseDao->sendRequest($requete);
 			$baseDao->close();
 		}
 	}
 	
 	public function findUtilisateur($login,$password){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$requete = "SELECT * FROM UTILISATEUR WHERE LOGIN='$login' AND MOT_DE_PASSE='$password'";
 			$resulat = $baseDao->sendRequest($requete);
 			$row = mysql_fetch_array($resulat, MYSQL_ASSOC);
 			if($row["ID_USER"] == null){
 				return null;
 			}
 			$utilisateur = $this->buildUtilisateur($row);
 			$baseDao->close();
 			return $utilisateur;
 	}
 	
 	public function buildUtilisateur($row){
  		$utilisateur = new Utilisateur();
 		$utilisateur->idUser = $row["ID_USER"];
 		$utilisateur->nom = $row["NOM"];
 		$utilisateur->prenom = $row["PRENOM"];
 		$utilisateur->login = $row["LOGIN"];
 		$utilisateur->mdp = $row["MOT_DE_PASSE"];
 		return $utilisateur;
 	}
 	
 	
 }