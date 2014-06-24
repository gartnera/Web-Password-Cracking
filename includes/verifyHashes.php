<?php
include_once('constants.php');

class HashValidator
{
	public static function validateHashType($hash_type)
	{
		foreach (Constants::$hash_cat_types as $id => $str) {
			if ($hash_type == $str){
				return $id;
			}
		}
		return -1;
	}

	public static function validateDictionary($name){
		return in_array($name, Constants::$dictionaries);
	}


	public static function verifyHashes($id, $hashes)
	{
		//TODO: add regexes to match hashes
		if (count($hashes) > 0){
			if (strlen($hashes[0]) > 0)
				return 1;
			else
				return 0;
		}
		else
			return 0;

	}
}