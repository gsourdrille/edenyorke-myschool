<?php 



class BaseDao {
	
	var $connection;
	
	public function connect(){
		$hote = Config::getProperties(Key::HOTE);
		$user = Config::getProperties(Key::USER);
		$mdp = Config::getProperties(Key::MDP);
		$base = Config::getProperties(Key::BASE);
		$this->connection = mysqli_connect($hote,$user, $mdp,$base);
	}
	
	public function close(){
			$this->connection=null;
	}
	
	public function sendRequest($request){
		// Creation d'un objet Logger
		$logger = new Logger(Config::getProperties(Key::LOGGER_LOCATION));
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
 



