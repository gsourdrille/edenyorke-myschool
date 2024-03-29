<?php 

include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/BaseDao.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/config/Config.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/constant/Key.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/exception/DaoException.php");

class BaseDaoImpl implements BaseDao{
	
	var $connection;
	var $logger;
	
	function __construct() {
		Logger::configure($_SERVER['DOCUMENT_ROOT']."/conf/log4php.xml");
		$this->logger = Logger::getLogger(__CLASS__);
		
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
			$this->logger->error($request);
			$this->logger->error(mysqli_error($this->connection));
			throw new DaoException("Erreur lors l'acces à la base de données");
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
 



