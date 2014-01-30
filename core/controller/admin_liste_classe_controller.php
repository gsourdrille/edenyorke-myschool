<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/admin_service.php");
include($_SERVER['DOCUMENT_ROOT']."/myschool/core/controller/commun_controller.php");
//Maj de la liste des classes
$listeClasse = getClassesByUser($utilisateur->idUser);
