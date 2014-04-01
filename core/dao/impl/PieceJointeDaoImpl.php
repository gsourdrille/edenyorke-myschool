<?php
include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/impl/BaseDaoImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/bean/PieceJointe.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/PieceJointeDao.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/utils/StringUtils.php");

class PieceJointeDaoImpl extends  BaseDaoImpl implements PieceJointeDao {
	
	
	public function savePieceJointe($idPost,$piecesJointes){
		$logger = Logger::getLogger(__CLASS__);
		if($idPost != null && $piecesJointes != null && count($piecesJointes) > 0){
			$this->connect();
			foreach ($piecesJointes as $pj){
				$path = $this->escapeString($pj->path);
				$idPj = uniqid('pj');
				$logger->debug("uniqid : ".$idPj);
				$requete = "INSERT INTO PIECE_JOINTE (ID_PJ, ID_POST,CONTENT_TYPE,PATH) VALUES ('$idPj' ,'$pj->idPost', '$pj->contentType', '$path' ) ";
				$result = $this->sendRequest($requete);
			}
			$this->close();
		}
	}
	
	public function deletePiecesJointes($listePiecesJointesId){
		if($listePiecesJointesId != null && count($listePiecesJointesId) > 0){
			$this->connect();
			foreach ($listePiecesJointesId as $pjId){
				$requete = "DELETE FROM PIECE_JOINTE WHERE ID_PJ = '$pjId'";
				$result = $this->sendRequest($requete);
			}
			$this->close();
		}
	}
	
	public function deletePieceJointe($pieceJointeId){
		if($pieceJointeId != null){
			$this->connect();
			$requete = "DELETE FROM PIECE_JOINTE WHERE ID_PJ = '$pieceJointeId'";
			$result = $this->sendRequest($requete);
			$this->close();
		}
	}
	
		
	public function findPiecesJointesFromPost($idPost){
			$this->connect();
			$requete = "SELECT * FROM PIECE_JOINTE WHERE ID_POST='$idPost'";
			$resulat = $this->sendRequest($requete);
			$listePiecesJointes = new ArrayObject();
			while($row = mysqli_fetch_assoc($resulat)){
				$listePiecesJointes->append($this->buildPieceJointe($row));
			}
			$this->close();
			return $listePiecesJointes;
	}
	
	public function findImagesFromPost($idPost){
		$this->connect();
		$requete = "SELECT * FROM PIECE_JOINTE WHERE ID_POST='$idPost' AND CONTENT_TYPE like 'image%'";
		$resulat = $this->sendRequest($requete);
		$listePiecesJointes = new ArrayObject();
		while($row = mysqli_fetch_assoc($resulat)){
			$listePiecesJointes->append($this->buildPieceJointe($row));
		}
		$this->close();
		return $listePiecesJointes;
	}
	
	public function findPieceJointe($idPj,$idPost){
		$this->connect();
		$requete = "SELECT * FROM PIECE_JOINTE WHERE ID_PJ='$idPj' AND ID_POST='$idPost'";
		$resulat = $this->sendRequest($requete);
		$row = mysqli_fetch_assoc($resulat);
		$pj = $this->buildPieceJointe($row);
		$this->close();
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