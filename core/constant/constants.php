<?php

include_once ("abstract_constants.php");

 class Constants extends AbstractConstants{
 	
 	const HOTE = 'localhost';
 	const USER = 'root';
 	const MDP = 'root';
 	const BASE = 'liveschool';
 	
 	const LOGGER_LOCATION  ='/Applications/MAMP/htdocs/liveschool/logs/';
 	
 	const PATH_DATA = '/Applications/MAMP/htdocs';
 	
 	const MAIL_REPLY_TO="donotreply@liveschool.fr";
 	const MAIL_FROM="gsourdrille@gmail.com";
 	const MAIL_FROM_NAME="liveschool";
 	const MAIL_VALID_URL_REPONSE="http://localhost:8888/liveschool/core/controller/valid_controller.php?token=";
 	const MAIL_DEMANDE_INCRIPTION="gsourdrille@gmail.com";
 	
 	
 	
 }

?>