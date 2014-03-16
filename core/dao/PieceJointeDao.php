<?php

interface PieceJointeDao extends BaseDao{
	
	
	public function savePieceJointe($idPost,$piecesJointes);
	
	public function deletePiecesJointes($listePiecesJointesId);
	
	public function deletePieceJointe($pieceJointeId);
	
	public function findPiecesJointesFromPost($idPost);
	
	public function findImagesFromPost($idPost);
	
	public function findPieceJointe($idPj,$idPost);
	
	public function buildPieceJointe($row);
	
}