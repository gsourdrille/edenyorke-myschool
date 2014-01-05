<?php



 class UtilisateurDao{
 	
 	public function saveUtilisateur($utilisateur,$type){
 		if($utilisateur != null){
  			$baseDao = new BaseDao();
 			$baseDao->connect();
 			
 			$nom = $baseDao->escapeString($utilisateur->nom);
 			$prenom = $baseDao->escapeString($utilisateur->prenom);
 			$login = $baseDao->escapeString($utilisateur->login);
 			
 			$requete = "INSERT INTO UTILISATEUR (NOM,PRENOM,LOGIN,MOT_DE_PASSE,ID_ETABLISSEMENT) 
 						VALUES ('$nom', '$prenom', '$login', '$utilisateur->mdp', '$utilisateur->etablissement') ";
 			$result = $baseDao->sendRequest($requete);
 			$requete = "SELECT LAST_INSERT_ID() FROM UTILISATEUR";
 			$result = $baseDao->lastInsertId();
 			$utilisateur->idUser = $result;
 			$requete = "INSERT INTO UTILISATEUR_TYPE_UTILISATEUR (ID_USER, ID_TYPE_UTILISATEUR) VALUES ('$utilisateur->idUser',$type)";
 			$result = $baseDao->sendRequest($requete);
 			$baseDao->close();
 			return $utilisateur;
 		}
 		
 	}
 	
 	public function saveUtilisateurTypeUtilisateur($utilisateur,$typesUtlisateurs){
  		if($utilisateur != null && $typesUtlisateurs != null){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
 			//Supression des anciennes relations
 			$requete = "DELETE FROM UTILISATEUR_TYPE_UTILISATEUR WHERE ID_USER=$utilisateur->idUser";
 			$result = $baseDao->sendRequest($requete);
 			foreach ($typesUtlisateurs as $typeUtilisateur) {
 				$requete = "INSERT INTO UTILISATEUR_TYPE_UTILISATEUR (ID_USER,ID_TYPE_UTILISATEUR)
 				VALUES ('$utilisateur->idUser', $typeUtilisateur) ";
 				$result = $baseDao->sendRequest($requete);
 			}
 			$baseDao->close();
 		}
 	}

 	public function updateUtilisateur($utilisateur){
 		if($utilisateur != null){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$nom = $baseDao->escapeString($utilisateur->nom);
 			$prenom = $baseDao->escapeString($utilisateur->prenom);
 			$login = $baseDao->escapeString($utilisateur->login);
 			
 			$requete = "UPDATE UTILISATEUR SET NOM='$nom', PRENOM='$prenom', LOGIN='$login',MOT_DE_PASSE='$utilisateur->mdp'
 						WHERE ID_USER=$utilisateur->idUser";
 			$result  = $baseDao->sendRequest($requete);
 			$baseDao->close();
 			if(!$result){
 				return false;
 			}else{
 				return true;
 			}
 		}
 	}
 	
 	public function deleteTypeUtilisateur($utilisateur, $typeUtilisateur){
 		if($utilisateur != null){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
	 		$requete = "DELETE FROM UTILISATEUR_TYPE_UTILISATEUR WHERE ID_USER = $utilisateur->idUser AND ID_TYPE_UTILISATEUR = $typeUtilisateur";
	 		$result = $baseDao->sendRequest($requete);
	 		$baseDao->close();
 		}
 	}
 	
 	public function deleteUtilisateur($idUser){
 		if($idUser != null){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$requete = "DELETE FROM UTILISATEUR WHERE ID_USER=$idUser";
 			$baseDao->sendRequest($requete);
 			$baseDao->close();
 		}
 	}
 	
 	public function findUtilisateur($login,$password){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$requete = "SELECT * FROM UTILISATEUR WHERE LOGIN='$login' AND MOT_DE_PASSE='$password'";
 			$resulat = $baseDao->sendRequest($requete);
 			$row = mysqli_fetch_array($resulat);
 			if($row["ID_USER"] == null){
 				return null;
 			}
 			$utilisateur = $this->buildUtilisateur($row);
 			$baseDao->close();
 			return $utilisateur;
 	}
 	
 	public function findUtilisateurByUsername($login){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		$requete = "SELECT * FROM UTILISATEUR WHERE LOGIN='$login'";
 		$resulat = $baseDao->sendRequest($requete);
 		$row = mysqli_fetch_array($resulat);
 		if($row["ID_USER"] == null){
 			return null;
 		}
 		$utilisateur = $this->buildUtilisateur($row);
 		$baseDao->close();
 		return $utilisateur;
 	}
 	
 	public function findTypeUtilisateur($utilisateur){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		$requete = "SELECT * FROM UTILISATEUR_TYPE_UTILISATEUR WHERE ID_USER='$utilisateur->idUser'";
 		$resulat = $baseDao->sendRequest($requete);
 		$listeTypesUtilisateurs = new ArrayObject();
 		while($row = mysqli_fetch_array($resulat)){
 			$listeTypesUtilisateurs->append($row["ID_TYPE_UTILISATEUR"]);
 		}
 		$baseDao->close();
 		return $listeTypesUtilisateurs;
 	}
 	
 	public function findUtilisateurByEtablissementAndType($idEtablissement, $type){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		$requete = "SELECT * FROM UTILISATEUR WHERE ID_ETABLISSEMENT='$idEtablissement' AND ID_USER IN (SELECT ID_USER FROM UTILISATEUR_TYPE_UTILISATEUR WHERE ID_TYPE_UTILISATEUR = '$type')";
 		$resulat = $baseDao->sendRequest($requete);
 		$listeUtilisateurs = new ArrayObject();
 		while($row = mysqli_fetch_array($resulat)){
 			$listeUtilisateurs->append($this->buildUtilisateur($row));  
 		}
 		$baseDao->close();
 		return $listeUtilisateurs;
 	}
 	
 	public function findUtilisateurById($idUser){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		$requete = "SELECT * FROM UTILISATEUR WHERE ID_USER='$idUser'";
 		$resulat = $baseDao->sendRequest($requete);
 		$row = mysqli_fetch_array($resulat);
 		if($row["ID_USER"] == null){
 			return null;
 		}
 		$utilisateur = $this->buildUtilisateur($row);
 		$baseDao->close();
 		return $utilisateur;
 	}
 	
 	public function setImageToUtilisateur($iduser, $imageName){
 		if($iduser != null && $imageName != null){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$requete = "UPDATE UTILISATEUR SET AVATAR='$imageName'
 			WHERE ID_USER=$iduser";
 			$result = $baseDao->sendRequest($requete);
 			$baseDao->close();
 			if(!$result){
 				return false;
 			}else{
 				return true;
 			}
 		}
 	
 	}
 	
 	public function buildUtilisateur($row){
  		$utilisateur = new Utilisateur();
 		$utilisateur->idUser = $row["ID_USER"];
 		$utilisateur->nom = $row["NOM"];
 		$utilisateur->prenom = $row["PRENOM"];
 		$utilisateur->login = $row["LOGIN"];
 		$utilisateur->mdp = $row["MOT_DE_PASSE"];
 		$utilisateur->etablissement = $row["ID_ETABLISSEMENT"];
 		$utilisateur->avatar = $row["AVATAR"];
 		return $utilisateur;
 	}
 	
 	
 }