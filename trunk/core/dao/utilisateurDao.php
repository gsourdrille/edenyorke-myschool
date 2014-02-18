<?php



 class UtilisateurDao{
 	
 	public function saveUtilisateur($utilisateur,$type){
 		if($utilisateur != null){
  			$baseDao = new BaseDao();
 			$baseDao->connect();
 			
 			$nom = $baseDao->escapeString($utilisateur->nom);
 			$prenom = $baseDao->escapeString($utilisateur->prenom);
 			$login = $baseDao->escapeString($utilisateur->login);
 			
 			$requete = "INSERT INTO UTILISATEUR (NOM,PRENOM,LOGIN,MOT_DE_PASSE,ID_ETABLISSEMENT,ACTIVE) 
 						VALUES ('$nom', '$prenom', '$login', '$utilisateur->mdp', '$utilisateur->etablissement',$utilisateur->active) ";
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
 			$requete = "SELECT * FROM UTILISATEUR WHERE LOGIN='$login' AND MOT_DE_PASSE='$password' AND ACTIVE=1";
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
 		$requete = "SELECT * FROM UTILISATEUR WHERE LOGIN='$login' AND ACTIVE=1";
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
 	
 	
 	public function ajouterToken($idUser, $token){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		$requete = "INSERT INTO ACTIVATION (ID_USER,TOKEN) VALUE ($idUser, '$token' )";
 		$resulat = $baseDao->sendRequest($requete);
 		$baseDao->close();
 	}
 	
 	public function activerUtilisateur($token){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		
 		//Est ce que le token est actif?
 		$requete = "SELECT * FROM ACTIVATION WHERE TOKEN='$token'";
 		$resulat = $baseDao->sendRequest($requete);
 		$row = mysqli_fetch_array($resulat);
 		if($row["ID_USER"] == null){
 			return false;
 		}
 		// Activation de l'utilisateur
 		$idUser = $row["ID_USER"] ;
 		$requete = "UPDATE UTILISATEUR SET ACTIVE=1 WHERE ID_USER='$idUser'";
 		$result = $baseDao->sendRequest($requete);
 		
 		//Suppression du token
 		$requete = "DELETE FROM ACTIVATION WHERE TOKEN='$token'";
 		$result = $baseDao->sendRequest($requete);
 		$baseDao->close();
 		return true;
 	}
 	
 	public function isUniqueToken($token){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 			
 		//Est ce que le token est actif?
 		$requete = "SELECT COUNT(*) FROM ACTIVATION WHERE TOKEN='$token'";
 		$resulat = $baseDao->sendRequest($requete); 
 		$result = $resulat->fetch_row();
 		$baseDao->close();
 		if($result[0] == 0){
 			return true;
 		}
 		return false;
 	}
 	
 	function saveAutologin($utilisateur,$key){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		$requete = "UPDATE UTILISATEUR SET LOGIN_TOKEN='$key' WHERE ID_USER='$utilisateur->idUser'";
 		$result = $baseDao->sendRequest($requete);
 		$baseDao->close();
 		return true;
 	}
 	
 	function getUtilisateurByLoginToken($key){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		$requete = "SELECT * FROM UTILISATEUR WHERE LOGIN_TOKEN='$key'";
 		$result = $baseDao->sendRequest($requete);
 		$row = mysqli_fetch_array($result);
 			if($row["ID_USER"] == null){
 				return null;
 			}
 			$utilisateur = $this->buildUtilisateur($row);
 			$baseDao->close();
 			return $utilisateur;
 	}
 	
 	
 	function getUtilisateurByEtablissement($idEtablissement){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		$requete = "SELECT * FROM UTILISATEUR WHERE ID_ETABLISSEMENT='$idEtablissement' AND ACTIVE=1";
 		$resulat = $baseDao->sendRequest($requete);
 		$listeUtilisateurs = new ArrayObject();
 		while($row = mysqli_fetch_array($resulat)){
 			$listeUtilisateurs->append($this->buildUtilisateur($row));
 		}
 		$baseDao->close();
 		return $listeUtilisateurs;
 	}
 	
 	function getUtilisateurByNiveaux($idNiveau){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		$requete = "SELECT * FROM UTILISATEUR WHERE ID_USER IN (SELECT ID_USER FROM UTILISATEUR_CLASSE WHERE ID_CLASSE IN (SELECT ID_CLASSE FROM CLASSE WHERE ID_NIVEAU = $idNiveau))  AND ACTIVE=1";
 		$resulat = $baseDao->sendRequest($requete);
 		$listeUtilisateurs = new ArrayObject();
 		while($row = mysqli_fetch_array($resulat)){
 			$listeUtilisateurs->append($this->buildUtilisateur($row));
 		}
 		$baseDao->close();
 		return $listeUtilisateurs;
 	}
 	
 	function getUtilisateurByClasses($idClasse){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		$requete = "SELECT * FROM UTILISATEUR WHERE ID_USER IN (SELECT ID_USER FROM UTILISATEUR_CLASSE WHERE ID_CLASSE = $idClasse)  AND ACTIVE=1";
 		$resulat = $baseDao->sendRequest($requete);
 		$listeUtilisateurs = new ArrayObject();
 		while($row = mysqli_fetch_array($resulat)){
 			$listeUtilisateurs->append($this->buildUtilisateur($row));
 		}
 		$baseDao->close();
 		return $listeUtilisateurs;
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