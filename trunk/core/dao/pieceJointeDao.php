<?php

class PieceJointeDao {
	
	
	public function savePieceJointe($idPost,$piecesJointes){
		if($idPost != null && $piecesJointes != null && count($piecesJointes) > 0){
			$baseDao = new BaseDao();
			$baseDao->connect();
			foreach ($piecesJointes as $pj){
				$requete = "INSERT INTO PIECE_JOINTE (ID_POST,CONTENT_TYPE,PATH) VALUES ('$pj->idPost', '$pj->contentType', '$pj->path' ) ";
				$result = $baseDao->sendRequest($requete);
			}
			$baseDao->close();
		}
	}
	
	public function deletePiecesJointes($listePiecesJointesId){
		if($listePiecesJointesId != null && count($listePiecesJointesId) > 0){
			$baseDao = new BaseDao();
			$baseDao->connect();
			foreach ($listePiecesJointesId as $pjId){
				$requete = "DELETE FROM PIECE_JOINTE WHERE ID_PJ = $pjId";
				$result = $baseDao->sendRequest($requete);
			}
			$baseDao->close();
		}
	}
	
	public function deletePieceJointe($pieceJointeId){
		if($pieceJointeId != null){
			$baseDao = new BaseDao();
			$baseDao->connect();
			$requete = "DELETE FROM PIECE_JOINTE WHERE ID_PJ = $pieceJointeId";
			$result = $baseDao->sendRequest($requete);
			$baseDao->close();
		}
	}
	
		
	public function findPiecesJointesFromPost($idPost){
			$baseDao = new BaseDao();
			$baseDao->connect();
			$requete = "SELECT * FROM PIECE_JOINTE WHERE ID_POST='$idPost'";
			$resulat = $baseDao->sendRequest($requete);
			$listePiecesJointes = new ArrayObject();
			while($row = mysqli_fetch_assoc($resulat)){
				$listePiecesJointes->append($this->buildPieceJointe($row));
			}
			$baseDao->close();
			return $listePiecesJointes;
	}
	
	public function findImagesFromPost($idPost){
		$baseDao = new BaseDao();
		$baseDao->connect();
		$requete = "SELECT * FROM PIECE_JOINTE WHERE ID_POST='$idPost' AND CONTENT_TYPE like 'image%'";
		$resulat = $baseDao->sendRequest($requete);
		$listePiecesJointes = new ArrayObject();
		while($row = mysqli_fetch_assoc($resulat)){
			$listePiecesJointes->append($this->buildPieceJointe($row));
		}
		$baseDao->close();
		return $listePiecesJointes;
	}
	
	public function findPieceJointe($idPj,$idPost){
		$baseDao = new BaseDao();
		$baseDao->connect();
		$requete = "SELECT * FROM PIECE_JOINTE WHERE ID_PJ='$idPj' AND ID_POST='$idPost'";
		$resulat = $baseDao->sendRequest($requete);
		$row = mysqli_fetch_assoc($resulat);
		$pj = $this->buildPieceJointe($row);
		$baseDao->close();
		return $pj;
	}
	
	public function buildPieceJointe($row){
		$pj = new PieceJointe();
		$pj->idPj = $row["ID_PJ"];
		$pj->idPost = $row["ID_POST"];
		$pj->contentType = $row["CONTENT_TYPE"];
		if(StringUtils::startsWith($pj->contentType, "image")){
			$pj->isImage = true;
		}else{
			$pj->isImage = false;
		}
		$pj->path = $row["PATH"];
		return $pj;
	}
	
}