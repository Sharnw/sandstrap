<?php

/*
*	Config management class
*
*	Loads an array of config variables and allows access via a get function
*/
class Config {

	private static $config = null;
	
	public static function load($vars) {
		$json = json_encode($vars);
		self::$config = json_decode($json);
	}

	/* 
	* 	Retrieve config strings from config array in the format key1.key2.key3 etc
	*/
	public static function get($identifier) {
		$parts = explode('.', $identifier);
		if (count($parts) > 1) {
			$obj = self::$config; $i = 0;
			while ($i < count($parts)) {
				if (!isset($obj->$parts[$i])) return false;
				$obj = $obj->$parts[$i]; $i++;
			}
			return $obj;
		}

		return self::$config->$identifier;
	}
	
}