<?php 

class BaseDao {
	
	
	var $hote = Constants::HOTE;
	var $user = Constants::USER;
	var $mdp = Constants::MDP;
	var $base = Constants::BASE;
	var $connection;
	
	public function connect(){
		try {
			$this->connection = new PDO('mysql:host='.$this->hote.';dbname='.$this->base', $this->user, $this->mdp);
		} catch (PDOException $e) {
			print "Erreur !: " . $e->getMessage() . "<br/>";
			die();
		}
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