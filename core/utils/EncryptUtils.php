<?php

include_once($_SERVER['DOCUMENT_ROOT']."/core/constant/Constants.php");
class EncryptUtils {
	
	const PASS_CHARS = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNOPQRSTUVWXYZ23456789';
	
	const ID_CHARS = '123456789';
	
	public static function generatePassword() {
		$length = Constants::PASS_CHARS_LENGTH;
		$count = mb_strlen(EncryptUtils::PASS_CHARS);
		for ($i = 0, $result = ''; $i < $length; $i++) {
			$index = rand(0, $count - 1);
			$result .= mb_substr(EncryptUtils::PASS_CHARS, $index, 1);
		}
		return $result;
	}
	
	public static function generateToken() {
		$length = Constants::TOKEN_LENGTH;
		$count = mb_strlen(EncryptUtils::PASS_CHARS);
		for ($i = 0, $result = ''; $i < $length; $i++) {
			$index = rand(0, $count - 1);
			$result .= mb_substr(EncryptUtils::PASS_CHARS, $index, 1);
		}
		return $result;
	}
	
	public static function generateId() {
		$length = Constants::ID_LENGTH;
		$count = mb_strlen(EncryptUtils::ID_CHARS);
		for ($i = 0, $result = ''; $i < $length; $i++) {
			$index = rand(0, $count - 1);
			$result .= mb_substr(EncryptUtils::ID_CHARS, $index, 1);
		}
		return $result;
	}
	
	
	
}