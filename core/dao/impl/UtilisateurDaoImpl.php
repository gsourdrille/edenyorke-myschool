<?php

include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/impl/BaseDaoImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/bean/Utilisateur.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/UtilisateurDao.php");

 class UtilisateurDaoImpl extends BaseDaoImpl implements UtilisateurDao {
 	
 	
 	public function saveUtilisateur($utilisateur,$type){
 		if($utilisateur != null){
 			$this->connect();
 			
 			$nom = $this->escapeString($utilisateur->nom);
 			$prenom = $this->escapeString($utilisateur->prenom);
 			$login = $this->escapeString($utilisateur->login);
 			
 			$requete = "INSERT INTO UTILISATEUR (NOM,PRENOM,LOGIN,MOT_DE_PASSE,ACTIVE) 
 						VALUES ('$nom', '$prenom', '$login', '$utilisateur->mdp',$utilisateur->active) ";
 			$result = $this->sendRequest($requete);
 			$requete = "SELECT LAST_INSERT_ID() FROM UTILISATEUR";
 			$result = $this->lastInsertId();
 			$utilisateur->idUser = $result;
 			$requete = "INSERT INTO UTILISATEUR_TYPE_UTILISATEUR (ID_USER, ID_TYPE_UTILISATEUR) VALUES ('$utilisateur->idUser',$type)";
 			$result = $this->sendRequest($requete);
 			$this->close();
 			return $utilisateur;
 		}
 		
 	}
 	
 	public function saveUtilisateurTypeUtilisateur($utilisateur,$typesUtlisateurs){
  		if($utilisateur != null && $typesUtlisateurs != null){
 			$this->connect();
 			//Supression des anciennes relations
 			$requete = "DELETE FROM UTILISATEUR_TYPE_UTILISATEUR WHERE ID_USER=$utilisateur->idUser";
 			$result = $this->sendRequest($requete);
 			foreach ($typesUtlisateurs as $typeUtilisateur) {
 				$requete = "INSERT INTO UTILISATEUR_TYPE_UTILISATEUR (ID_USER,ID_TYPE_UTILISATEUR)
 				VALUES ('$utilisateur->idUser', $typeUtilisateur) ";
 				$result = $this->sendRequest($requete);
 			}
 			$this->close();
 		}
 	}

 	public function updateUtilisateur($utilisateur){
 		if($utilisateur != null){
 			$this->connect();
 			$nom = $this->escapeString($utilisateur->nom);
 			$prenom = $this->escapeString($utilisateur->prenom);
 			$login = $this->escapeString($utilisateur->login);
 			
 			$requete = "UPDATE UTILISATEUR SET NOM='$nom', PRENOM='$prenom', LOGIN='$login',MOT_DE_PASSE='$utilisateur->mdp'
 						WHERE ID_USER=$utilisateur->idUser";
 			$result  = $this->sendRequest($requete);
 			$this->close();
 			if(!$result){
 				return false;
 			}else{
 				return true;
 			}
 		}
 	}
 	
 	public function deleteTypeUtilisateur($utilisateur, $typeUtilisateur){
 		if($utilisateur != null){
 			$this->connect();
	 		$requete = "DELETE FROM UTILISATEUR_TYPE_UTILISATEUR WHERE ID_USER = $utilisateur->idUser AND ID_TYPE_UTILISATEUR = $typeUtilisateur";
	 		$result = $this->sendRequest($requete);
	 		$this->close();
 		}
 	}
 	
 	public function deleteUtilisateur($idUser){
 		if($idUser != null){
 			$this->connect();
 			$requete = "DELETE FROM UTILISATEUR WHERE ID_USER=$idUser";
 			$this->sendRequest($requete);
 			$this->close();
 		}
 	}
 	
 	public function findUtilisateur($login,$password){
 			$this->connect();
 			$requete = "SELECT * FROM UTILISATEUR WHERE LOGIN='$login' AND MOT_DE_PASSE='$password' AND ACTIVE=1";
 			$resulat = $this->sendRequest($requete);
 			$row = mysqli_fetch_array($resulat);
 			if($row["ID_USER"] == null){
 				return null;
 			}
 			$utilisateur = $this->buildUtilisateur($row);
 			$this->close();
 			return $utilisateur;
 	}
 	
 	public function findUtilisateurByUsername($login){
 		$this->connect();
 		$requete = "SELECT * FROM UTILISATEUR WHERE LOGIN='$login' AND ACTIVE=1";
 		$resulat = $this->sendRequest($requete);
 		$row = mysqli_fetch_array($resulat);
 		if($row["ID_USER"] == null){
 			return null;
 		}
 		$utilisateur = $this->buildUtilisateur($row);
 		$this->close();
 		return $utilisateur;
 	}
 	
 	public function findTypeUtilisateur($utilisateur){
 		$this->connect();
 		$requete = "SELECT * FROM UTILISATEUR_TYPE_UTILISATEUR WHERE ID_USER='$utilisateur->idUser'";
 		$resulat = $this->sendRequest($requete);
 		$listeTypesUtilisateurs = new ArrayObject();
 		while($row = mysqli_fetch_array($resulat)){
 			$listeTypesUtilisateurs->append($row["ID_TYPE_UTILISATEUR"]);
 		}
 		$this->close();
 		return $listeTypesUtilisateurs;
 	}
 	
 	public function findUtilisateurByEtablissementAndType($idEtablissement, $type){
 		$this->connect();
 		$requete = "SELECT * FROM UTILISATEUR WHERE ID_USER IN (SELECT ID_USER FROM UTILISATEUR_TYPE_UTILISATEUR WHERE ID_TYPE_UTILISATEUR = '$type') AND ID_USER IN (SELECT ID_USER FROM UTILISATEUR_ETABLISSEMENT WHERE ID_ETABLISSEMENT = '$idEtablissement')";
 		$resulat = $this->sendRequest($requete);
 		$listeUtilisateurs = new ArrayObject();
 		while($row = mysqli_fetch_array($resulat)){
 			$listeUtilisateurs->append($this->buildUtilisateur($row));  
 		}
 		$this->close();
 		return $listeUtilisateurs;
 	}
 	
 	public function findUtilisateurById($idUser){
 		$this->connect();
 		$requete = "SELECT * FROM UTILISATEUR WHERE ID_USER='$idUser'";
 		$resulat = $this->sendRequest($requete);
 		$row = mysqli_fetch_array($resulat);
 		if($row["ID_USER"] == null){
 			return null;
 		}
 		$utilisateur = $this->buildUtilisateur($row);
 		$this->close();
 		return $utilisateur;
 	}
 	
 	public function setImageToUtilisateur($iduser, $imageName){
 		if($iduser != null){
 			$this->connect();
 			if(StringUtils::isEmpty($imageName)){
 				$requete = "UPDATE UTILISATEUR SET AVATAR=null WHERE ID_USER=$iduser";
 			}else{
 				$requete = "UPDATE UTILISATEUR SET AVATAR='$imageName' WHERE ID_USER=$iduser";
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
 	
 	
 	public function ajouterToken($idUser, $token){
 		$this->connect();
 		$requete = "INSERT INTO ACTIVATION (ID_USER,TOKEN) VALUE ($idUser, '$token' )";
 		$resulat = $this->sendRequest($requete);
 		$this->close();
 	}
 	
 	public function activerUtilisateur($token){
 		$this->connect();
 		
 		//Est ce que le token est actif?
 		$requete = "SELECT * FROM ACTIVATION WHERE TOKEN='$token'";
 		$resulat = $this->sendRequest($requete);
 		$row = mysqli_fetch_array($resulat);
 		if($row["ID_USER"] == null){
 			return false;
 		}
 		// Activation de l'utilisateur
 		$idUser = $row["ID_USER"] ;
 		$requete = "UPDATE UTILISATEUR SET ACTIVE=1 WHERE ID_USER='$idUser'";
 		$result = $this->sendRequest($requete);
 		
 		//Suppression du token
 		$requete = "DELETE FROM ACTIVATION WHERE TOKEN='$token'";
 		$result = $this->sendRequest($requete);
 		$this->close();
 		return true;
 	}
 	
 	public function isUniqueToken($token){
 		$this->connect();
 			
 		//Est ce que le token est actif?
 		$requete = "SELECT COUNT(*) FROM ACTIVATION WHERE TOKEN='$token'";
 		$resulat = $this->sendRequest($requete); 
 		$result = $resulat->fetch_row();
 		$this->close();
 		if($result[0] == 0){
 			return true;
 		}
 		return false;
 	}
 	
 	function saveAutologin($utilisateur,$key){
 		$this->connect();
 		$requete = "UPDATE UTILISATEUR SET LOGIN_TOKEN='$key' WHERE ID_USER='$utilisateur->idUser'";
 		$result = $this->sendRequest($requete);
 		$this->close();
 		return true;
 	}
 	
 	function getUtilisateurByLoginToken($key){
 		$this->connect();
 		$requete = "SELECT * FROM UTILISATEUR WHERE LOGIN_TOKEN='$key'";
 		$result = $this->sendRequest($requete);
 		$row = mysqli_fetch_array($result);
 			if($row["ID_USER"] == null){
 				return null;
 			}
 			$utilisateur = $this->buildUtilisateur($row);
 			$this->close();
 			return $utilisateur;
 	}
 	
 	
 	function getUtilisateurByEtablissement($idEtablissement){
 		$this->connect();
 		$requete = "SELECT * FROM UTILISATEUR WHERE ID_USER IN (SELECT ID_USER FROM UTILISATEUR_ETABLISSEMENT WHERE ID_ETABLISSEMENT='$idEtablissement') AND ACTIVE=1";
 		$resulat = $this->sendRequest($requete);
 		$listeUtilisateurs = new ArrayObject();
 		while($row = mysqli_fetch_array($resulat)){
 			$listeUtilisateurs->append($this->buildUtilisateur($row));
 		}
 		$this->close();
 		return $listeUtilisateurs;
 	}
 	
 	function getUtilisateurByNiveaux($idNiveau){
 		$this->connect();
 		$requete = "SELECT * FROM UTILISATEUR WHERE ID_USER IN (SELECT ID_USER FROM UTILISATEUR_CLASSE WHERE ID_CLASSE IN (SELECT ID_CLASSE FROM CLASSE WHERE ID_NIVEAU = $idNiveau))  AND ACTIVE=1";
 		$resulat = $this->sendRequest($requete);
 		$listeUtilisateurs = new ArrayObject();
 		while($row = mysqli_fetch_array($resulat)){
 			$listeUtilisateurs->append($this->buildUtilisateur($row));
 		}
 		$this->close();
 		return $listeUtilisateurs;
 	}
 	
 	function getUtilisateurByClasses($idClasse){
 		$this->connect();
 		$requete = "SELECT * FROM UTILISATEUR WHERE ID_USER IN (SELECT ID_USER FROM UTILISATEUR_CLASSE WHERE ID_CLASSE = $idClasse)  AND ACTIVE=1";
 		$resulat = $this->sendRequest($requete);
 		$listeUtilisateurs = new ArrayObject();
 		while($row = mysqli_fetch_array($resulat)){
 			$listeUtilisateurs->append($this->buildUtilisateur($row));
 		}
 		$this->close();
 		return $listeUtilisateurs;
 	}
 	
 	public function addEtablissementToUtilisateur($etablissementId, $userId){
 		$this->connect();
 		$requete = "INSERT INTO UTILISATEUR_ETABLISSEMENT (ID_USER, ID_ETABLISSEMENT) VALUES ($userId, $etablissementId)";
 		$resulat = $this->sendRequest($requete);
 		$this->close();
 	}
 	
 	public function deleteEtablissementToUtilisateur($etablissementId, $userId){
 		$this->connect();
 		$requete = "DELETE FROM UTILISATEUR_ETABLISSEMENT WHERE ID_USER=$userId AND ID_ETABLISSEMENT=$etablissementId";
 		$resulat = $this->sendRequest($requete);
 		$this->close();
 	}
 	
 	
 	public function buildUtilisateur($row){
  		$utilisateur = new Utilisateur();
 		$utilisateur->idUser = $row["ID_USER"];
 		$utilisateur->nom = $row["NOM"];
 		$utilisateur->prenom = $row["PRENOM"];
 		$utilisateur->login = $row["LOGIN"];
 		$utilisateur->mdp = $row["MOT_DE_PASSE"];
 		$utilisateur->avatar = $row["AVATAR"];
 		return $utilisateur;
 	}
 	
 	
 	
 }