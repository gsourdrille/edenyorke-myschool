<?php 


interface BaseDao {
	
	public function connect();
	
	public function close();
	
	public function sendRequest($request);
	
	public function escapeString($value);
	
	public function lastInsertId();
}
 



