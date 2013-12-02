<?php



 class PostDao{
 	
 	public function savePost($post){
 		if($post != null){
  			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$contenu = $baseDao->escapeString($post->contenu);
 			$requete = "INSERT INTO POST (ID_USER,CONTENU) VALUES ('$post->createur', '$post->$contenu') ";
 			$result = $baseDao->sendRequest($requete);
 			$idPost = $baseDao->lastInsertId();
 			$post->idPost = $idPost;
 			$baseDao->close();
 			return $post;
 		}
 		
 	}
 	
 	
 	public function updatePost($post){
 		if($post != null){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$contenu = $baseDao->escapeString($post->contenu);
 			$requete = "UPDATE POST SET CONTENU='$contenu' WHERE ID_POST=$post->idPost";
 			$result  = $baseDao->sendRequest($requete);
 			$baseDao->close();
 			if(!$result){
 				return false;
 			}else{
 				return true;
 			}
 		}
 	}
 	
 	 	
 	public function deletePost($idPost){
 		if($idPost != null){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$requete = "DELETE FROM POST WHERE ID_POST=$idPost";
 			$baseDao->sendRequest($requete);
 			$baseDao->close();
 		}
 	}
 	
 	public function findPost($idPost){
 			$baseDao = new BaseDao();
 			$baseDao->connect();
 			$requete = "SELECT * FROM POST WHERE ID_POST='$idPost'";
 			$resulat = $baseDao->sendRequest($requete);
 			$row = mysqli_fetch_assoc($resulat);
 			if($row["ID_POST"] == null){
 				return null;
 			}
 			$post = $this->buildPost($row);
 			$baseDao->close();
 			return $post;
 	}
 	
 	
 	
 	public function buildPost($row){
  		$post = new Post();
 		$post->idPost = $row["ID_POST"];
 		$post->createur = $row["ID_USER"];
 		$post->contenu = $row["CONTENU"];
 		$post->dateCreation = $row["DATE_CREATION"];
 		$post->dateModification = $row["DATE_DERNIERE_MODIFICATION"];
 		return $post;
 	}
 	
 	
 }