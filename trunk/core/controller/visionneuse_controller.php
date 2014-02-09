<?php
require ($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/post_service.php");
$idPost = $_GET['idPost'];
$listeImages = getImagesFromPost($idPost);
		


