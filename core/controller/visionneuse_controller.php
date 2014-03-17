<?php
require ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/PostServiceImpl.php");
$postService = new PostServiceImpl();
$idPost = $_GET['idPost'];
$listeImages = $postService->getImagesFromPost($idPost);
		


