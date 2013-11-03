<?php 

require_once('bootstrap.php');

$userTable = UTILISATEURTable::getInstance();
$user = $userTable->find(1);
echo $user->login
 
?>