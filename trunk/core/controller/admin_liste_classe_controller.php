<?php
@session_start();
include_once ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/AdminServiceImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/controller/commun_controller.php");

$adminService = new AdminServiceImpl();
//Maj de la liste des classes
$listeClasse = $adminService->getClassesByUser($utilisateur->idUser);
