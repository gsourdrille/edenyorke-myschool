<?php 



class BaseDao {
	

	var $hote = Constants::HOTE;
	var $user = Constants::USER;
	var $mdp = Constants::MDP;
	var $base = Constants::BASE;
	var $connection;
	
	public function connect(){
			$this->connection = mysqli_connect($this->hote,$this->user, $this->mdp,$this->base);
	}
	
	public function close(){
			$this->connection=null;
	}
	
	public function sendRequest($request){
		// Creation d'un objet Logger
		$logger = new Logger(Constants::LOGGER_LOCATION);
		$logger->log('access', 'acces', $request , Logger::GRAN_VOID);
		$charset = mysqli_query($this->connection,"SET NAMES UTF8");
		$ressource = mysqli_query($this->connection,$request) ;
		return $ressource;
	}
	
	public function escapeString($value){
		return mysqli_real_escape_string($this->connection, $value);
	}
	
	public function lastInsertId(){
		return mysqli_insert_id($this->connection);
	}
}
 



