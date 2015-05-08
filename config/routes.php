<?php

$hello = function($app, $name='world') {
    return $app->render('hello.html', array(
        'name' => $name,
        'title' => 'Hello Hello'
    ));
};

$routes = [
	'/' => $hello,
	'/hello/<string>' => $hello,
	'/test' => function() {
		return 'Test!';
	},
];

?>