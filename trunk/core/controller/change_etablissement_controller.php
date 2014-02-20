<?php
@session_start();

if(isset($_GET['etablissement'])){
	$_SESSION['ETABLISSEMENT_ID'] = $_GET['etablissement'];
	
}

header("location:/core/controller/tableau_controller.php");
