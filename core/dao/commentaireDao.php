<?php

class CommentaireDao {
	
	
	public function saveCommentaire($commentaire){
		if($commentaire != null){
			$baseDao = new BaseDao();
			$baseDao->connect();
			$contenu = $baseDao->escapeString($commentaire->contenu);
			$requete = "INSERT INTO COMMENTAIRE (ID_POST,ID_USER,CONTENU) VALUES ('$commentaire->idPost', '$commentaire->idUser', '$contenu' ) ";
			$result = $baseDao->sendRequest($requete);
			$idCommentaire = $baseDao->lastInsertId();
			$commentaire->idCommentaire = $idCommentaire;
			$baseDao->close();
			return $commentaire;
		}
	}
	
	public function updateCommentaire ($commentaire){
		if($commentaire != null){
			$baseDao = new BaseDao();
			$baseDao->connect();
			$contenu = $baseDao->escapeString($commentaire->contenu);
			$requete = "UPDATE COMMENTAIRE SET CONTENU='$contenu' WHERE ID_COMMENTAIRE=$commentaire->idCommentaire";
			$result  = $baseDao->sendRequest($requete);
			$baseDao->close();
			if(!$result){
				return false;
			}else{
				return true;
			}
		}
	}
	
	public function deleteCommentaire($idCommentaire){
		if($idCommentaire != null){
			$baseDao = new BaseDao();
			$baseDao->connect();
			$requete = "DELETE FROM COMMENTAIRE WHERE ID_COMMENTAIRE=$idCommentaire";
			$baseDao->sendRequest($requete);
			$baseDao->close();
		}
	}
	
	public function deleteCommentaireToUtilisateur($idUser){
		if($idCommentaire != null){
			$baseDao = new BaseDao();
			$baseDao->connect();
			$requete = "DELETE FROM COMMENTAIRE WHERE ID_USER=$idUser";
			$baseDao->sendRequest($requete);
			$baseDao->close();
		}
	}
	
	public function findCommentairesFromPost($idPost, $offset, $nbResultat){
			$baseDao = new BaseDao();
			$baseDao->connect();
			$requete = "SELECT * FROM COMMENTAIRE WHERE ID_POST='$idPost' ORDER BY DATE_CREATION DESC LIMIT $nbResultat OFFSET $offset";
			$resulat = $baseDao->sendRequest($requete);
			$listeCommentaires = new ArrayObject();
			while($row = mysqli_fetch_assoc($resulat)){
				$listeCommentaires->append($this->buildCommentaire($row));
			}
			$baseDao->close();
			return $listeCommentaires;
	}
	
	public function findCommentaire($idCommentaire){
		$baseDao = new BaseDao();
		$baseDao->connect();
		$requete = "SELECT * FROM COMMENTAIRE WHERE ID_COMMENTAIRE='$idCommentaire'";
		$resulat = $baseDao->sendRequest($requete);
		$row = mysqli_fetch_assoc($resulat);
		$commentaire = $this->buildCommentaire($row);
		$baseDao->close();
		return $commentaire;
	}
	
	public function countCommentairesFromPost($idPost){
		$baseDao = new BaseDao();
		$baseDao->connect();
		$requete = "SELECT COUNT(*) FROM COMMENTAIRE WHERE ID_POST='$idPost'";
		$resulat = $baseDao->sendRequest($requete);
		$result = $resulat->fetch_row();
 		$baseDao->close();
 		return $result[0];
	}
	
	public function buildCommentaire($row){
		$commentaire = new Commentaire();
		$commentaire->idCommentaire = $row["ID_COMMENTAIRE"];
		$commentaire->idPost = $row["ID_POST"];
		$commentaire->idUser = $row["ID_USER"];
		$commentaire->contenu = $row["CONTENU"];
		$commentaire->dateCreation = new DateTime($row["DATE_CREATION"]);
		return $commentaire;
	}
	
}