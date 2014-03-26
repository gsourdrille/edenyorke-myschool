<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT']."/core/controller/commun_controller.php");
if($_SESSION['TYPE_UTILISATEUR'] != TypeUtilisateur::DIRECTION){
	header("location:/moncompte");
}