<?php 

class BaseDao {
	
	
	var $hote = Constants::HOTE;
	var $user = Constants::USER;
	var $mdp = Constants::MDP;
	var $base = Constants::BASE;
	var $connection;
	
	public function connect(){
			$this->connection = mysql_connect($this->hote,$this->user, $this->mdp);
			mysql_select_db($this->base,$this->connection);
	}
	
	public function close(){
			$this->connection=null;
	}
	
	public function sendRequest($request){
		$ressource = mysql_query($request,$this->connection) ;
		return $ressource;
	}
}
 
?>


