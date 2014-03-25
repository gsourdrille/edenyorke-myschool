<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT']."/core/controller/commun_controller.php");
if($GET_['erreur']=='500'){
	require ($_SERVER['DOCUMENT_ROOT']."/html/html/erreur/500/index.php");
}