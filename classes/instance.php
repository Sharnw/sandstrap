<?php 

/*
	Instance management class

	Creates/prepares initial objects and then fetches in singleton pattern using get() method.

	Useful for quickly implementing 3rd party libraries.
*/
class Instance {

	private static $instances = [];

	public static function get($id) {
		if (!empty(self::$instances[$id])) return self::$instances[$id];

		$m = 'create_'.strtolower($id);
		if (method_exists(__CLASS__, $m)) {
			$test = call_user_func([__CLASS__, $m]);
			return call_user_func([__CLASS__, $m]);
		}

		return false;
	}

	public static function create_cache() {
		$cache = Grab::c('cache');
		self::$instances['cache'] = new Memcache;
		self::$instances['cache']->connect($cache->host, $cache->port);
		return self::$instances['cache'];
	}

	public static function create_time() {
		self::$instances['time'] = time();
		return self::$instances['time'];
	}

	public static function create_ham() {
		self::$instances['ham'] = new Ham('sandstrap', false, 'logs/' . date('Y-m-d') . '.txt');
		self::$instances['ham']->layout = 'layout.html';
		self::$instances['ham']->template_paths = [BASE_DIR.'/templates/'];

		include BASE_DIR.'/config/routes.php';

		foreach ($routes as $string => $callback) {
			self::$instances['ham']->route($string, $callback);
		}

		return self::$instances['ham'];
	}

}

?>