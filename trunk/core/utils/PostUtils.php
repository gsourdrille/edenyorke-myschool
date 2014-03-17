<?php

class PostUtils {

	public static function isInAssociation($listAssociations, $typePost, $id) {
		
		foreach ($listAssociations as $association){
			if($association->typePost == $typePost && $association->id == $id){
				return true;
			}
		}
		return false;
		
	}

}