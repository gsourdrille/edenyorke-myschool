<?php


class EncryptUtils {
	
	const PASS_CHARS = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNOPQRSTUVWXYZ23456789';
	
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
	
}