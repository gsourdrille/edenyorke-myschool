<?php

include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/impl/BaseDaoImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/bean/Commentaire.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/CommentaireDao.php");

class CommentaireDaoImpl extends BaseDaoImpl implements CommentaireDao{
	
	
	public function saveCommentaire($commentaire){
		if($commentaire != null){
			$this->connect();
			$contenu = $this->escapeString($commentaire->contenu);
			$idCommentaire = uniqid('o');
			$requete = "INSERT INTO COMMENTAIRE (ID_COMMENTAIRE,ID_POST,ID_USER,CONTENU) VALUES ('$idCommentaire','$commentaire->idPost', '$commentaire->idUser', '$contenu' ) ";
			$result = $this->sendRequest($requete);
			$commentaire->idCommentaire = $idCommentaire;
			$this->close();
			return $commentaire;
		}
	}
	
	public function updateCommentaire ($commentaire){
		if($commentaire != null){
			$this->connect();
			$contenu = $this->escapeString($commentaire->contenu);
			$requete = "UPDATE COMMENTAIRE SET CONTENU='$contenu' WHERE ID_COMMENTAIRE='$commentaire->idCommentaire'";
			$result  = $this->sendRequest($requete);
			$this->close();
			if(!$result){
				return false;
			}else{
				return true;
			}
		}
	}
	
	public function deleteCommentaire($idCommentaire){
		if($idCommentaire != null){
			$this->connect();
			$requete = "DELETE FROM COMMENTAIRE WHERE ID_COMMENTAIRE='$idCommentaire'";
			$this->sendRequest($requete);
			$this->close();
		}
	}
	
	public function deleteCommentaireToUtilisateur($idUser){
		if($idCommentaire != null){
			$this->connect();
			$requete = "DELETE FROM COMMENTAIRE WHERE ID_USER='$idUser'";
			$this->sendRequest($requete);
			$this->close();
		}
	}
	
	public function findCommentairesFromPost($idPost, $offset, $nbResultat){
			$this->connect();
			$requete = "SELECT * FROM COMMENTAIRE WHERE ID_POST='$idPost' ORDER BY DATE_CREATION DESC LIMIT $nbResultat OFFSET $offset";
			$resulat = $this->sendRequest($requete);
			$listeCommentaires = new ArrayObject();
			while($row = mysqli_fetch_assoc($resulat)){
				$listeCommentaires->append($this->buildCommentaire($row));
			}
			$this->close();
			return $listeCommentaires;
	}
	
	public function findCommentaire($idCommentaire){
		$this->connect();
		$requete = "SELECT * FROM COMMENTAIRE WHERE ID_COMMENTAIRE='$idCommentaire'";
		$resulat = $this->sendRequest($requete);
		$row = mysqli_fetch_assoc($resulat);
		$commentaire = $this->buildCommentaire($row);
		$this->close();
		return $commentaire;
	}
	
	public function countCommentairesFromPost($idPost){
		$this->connect();
		$requete = "SELECT COUNT(*) FROM COMMENTAIRE WHERE ID_POST='$idPost'";
		$resulat = $this->sendRequest($requete);
		$result = $resulat->fetch_row();
 		$this->close();
 		return $result[0];
	}
	
	public function buildCommentaire($row){
		date_default_timezone_set('Europe/Paris');
		$commentaire = new Commentaire();
		$commentaire->idCommentaire = $row["ID_COMMENTAIRE"];
		$commentaire->idPost = $row["ID_POST"];
		$commentaire->idUser = $row["ID_USER"];
		$commentaire->contenu = $row["CONTENU"];
		$commentaire->dateCreation = new DateTime($row["DATE_CREATION"]);
		return $commentaire;
	}
	
}