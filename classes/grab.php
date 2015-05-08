<?php

/*
	This is just an alias class to shorten the use of Instance::get and Config::get.

	Also an excuse to be able to type Grab::i('ham') a lot.
*/
class Grab {

	public static function i($instance_name) {
		return Instance::get($instance_name);
	}

	public static function c($config_string_id) {
		return Config::get($config_string_id);
	}
}

?>