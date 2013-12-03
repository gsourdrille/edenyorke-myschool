<?php

class PieceJointeDao {
	
	
	public function savePieceJointe($idPost,$piecesJointes){
		if($idPost != null && $piecesJointes != null && count($piecesJointes) > 0){
			$baseDao = new BaseDao();
			$baseDao->connect();
			$requete = "DELETE FROM PIECE_JOINTE WHERE ID_POST = $idPost";
			$result = $baseDao->sendRequest($requete);
			foreach ($piecesJointes as $pj){
				$requete = "INSERT INTO PIECE_JOINTE (ID_POST,CONTENT_TYPE,PATH) VALUES ('$pj->idPost', '$pj->contentType', '$pj->path' ) ";
				$result = $baseDao->sendRequest($requete);
			}
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
	
	public function buildPieceJointe($row){
		$pj = new PieceJointe();
		$pj->idPj = $row["ID_PJ"];
		$pj->idPost = $row["ID_POST"];
		$pj->contentType = $row["CONTENT_TYPE"];
		$pj->path = $row["PATH"];
		return $pj;
	}
	
}