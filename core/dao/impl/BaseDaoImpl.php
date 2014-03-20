<?php 

include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/BaseDao.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/config/Config.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/constant/Key.php");

class BaseDaoImpl implements BaseDao{
	
	var $connection;
	var $logger;
	
	function __construct() {
		$this->logger = new Logger(Config::getProperties(Key::LOGGER_LOCATION));
	}
	
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
		$charset = mysqli_query($this->connection,"SET NAMES UTF8");
		$ressource = mysqli_query($this->connection,$request) ;
		if(!$ressource){
			$this->logger->log('access', 'bdd_error', $request , Logger::GRAN_VOID);
			$this->logger->log('access', 'bdd_error', mysqli_error($this->connection) , Logger::GRAN_VOID);
		}
		return $ressource;
	}
	
	public function escapeString($value){
		return mysqli_real_escape_string($this->connection, $value);
	}
	
	public function lastInsertId(){
		return mysqli_insert_id($this->connection);
	}
}
 



