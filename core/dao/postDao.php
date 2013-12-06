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
 	
 	public function saveAssociations($post){
 		if($post != null && $post->associations != null){
 			$baseDao->connect();
 			foreach ($post->associations as $association){
 				switch ($associatio->typePose){
 					case TypePost::ETABLISSEMENT:
 						$requete = "INSERT INTO POST_ETABLISSEMENT (ID_POST,ID_ETABLISSEMENT) VALUES ('$post->idPost', $association->$id') ";
 					break;
 						
 					case TypePost::NIVEAU:
 						$requete = "INSERT INTO POST_NIVEAU (ID_POST,ID_NIVEAU) VALUES ('$post->idPost', $association->$id') ";
 					break;
 					
 					case TypePost::CLASSE:
 						$requete = "INSERT INTO POST_CLASSE (ID_POST,ID_CLASSE) VALUES ('$post->idPost', $association->$id') ";
 					break;
 				}
 				$result = $baseDao->sendRequest($requete);
 			}
 			$baseDao->close();
 		}
 	}
 	
 	
 	public function deleteAssociations($idPost){
 		if($idPost != null){
 			$baseDao->connect();
 			$requete = "DELETE FROM POST_ETABLISSEMENT WHERE ID_POST = $idPost ";
 			$result = $baseDao->sendRequest($requete);
 			$requete = "DELETE FROM POST_NIVEAU WHERE ID_POST = $idPost ";
 			$result = $baseDao->sendRequest($requete);
 			$requete = "DELETE FROM POST_CLASSE WHERE ID_POST = $idPost ";
 			$result = $baseDao->sendRequest($requete);
 			$baseDao->close();
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
 	
 	public function getAllPosts($idEtablissement, $idClasses, $idsNiveaux, $nbResultat, $offset){
 		$baseDao = new BaseDao();
 		$baseDao->connect();
 		$requeteClasse = "";
 		if(count($idClasses)>0){
 			$idClassesSQL = join(',',(array)$idClasses);
 			$requeteClasse = "UNION SELECT ID_POST FROM POST_CLASSE WHERE ID_CLASSE IN ($idClassesSQL)";
 		}
 		$requeteNiveau = "";
 		if(count($idsNiveaux)){
 			$idNiveauxSQL = join(',',(array)$idsNiveaux);
 			$requeteNiveau  = "UNION SELECT ID_POST FROM POST_NIVEAU WHERE ID_NIVEAU IN ($idNiveauxSQL)";
 		}
 		$requete = "SELECT * FROM POST WHERE ID_POST IN (SELECT ID_POST FROM POST_ETABLISSEMENT WHERE ID_ETABLISSEMENT = '$idEtablissement' 
 		$requeteClasse
 		$requeteNiveau) ORDER BY DATE_CREATION LIMIT $nbResultat OFFSET $offset";
 		$resulat = $baseDao->sendRequest($requete);
 		$listePosts = new ArrayObject();
 		while($row = mysqli_fetch_assoc($resulat)){
 			$listePosts->append($this->buildPost($row));
 		}
 		$baseDao->close();
 		return $listePosts;
 	}
 	
 	
 	
 	public function buildPost($row){
  		$post = new Post();
 		$post->idPost = $row["ID_POST"];
 		$post->createur = $row["ID_USER"];
 		$post->contenu = $row["CONTENU"];
 		$post->dateCreation = $row["DATE_CREATION"];
 		$post->dateModification = $row["DATE_DERNIERE_MODIFICATION"];
 		$post->commentairesActives = $row['COMMENTAIRES_ACTIVES'];
 		return $post;
 	}
 	
 	 	
 	
 }