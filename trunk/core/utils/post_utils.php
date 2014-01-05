<?php

class PostUtils {

	public static function isInAssociation($listAssociations, $typePost, $id) {
		$logger = new Logger(Constants::LOGGER_LOCATION);
		
		foreach ($listAssociations as $association){
			$logger->log('succes', 'myschool', "BASE : TYPE :".$association->typePost." ID :".$association->id , Logger::GRAN_VOID);
			$logger->log('succes', 'myschool', "ORIGINE : TYPE :".$typePost." ID :".$id , Logger::GRAN_VOID);
			if($association->typePost == $typePost && $association->id == $id){
				$logger->log('succes', 'myschool', "MATCH OK" , Logger::GRAN_VOID);
				return true;
			}
		}
		$logger->log('succes', 'myschool', "MATCH KO" , Logger::GRAN_VOID);
		return false;
		
	}

}