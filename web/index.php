<?php

	define('BASE_DIR', dirname(__FILE__).'/..');

	// autoload our classes
	function __autoload($class_name) {
	    include BASE_DIR."/classes/".str_replace('_','/',strtolower($class_name)) . '.php';
	}

	// load config
	Config::load(parse_ini_file(BASE_DIR."/config/config.ini", true));

	// grabbing some ham
	$ham = Grab::i('ham');

	// run ham router
	$ham->run();
	
?>