<?php

$Injector = new \Auryn\Injector;

/**
 * HTTP objects are shared because there would not be much point in adding content to
 * one object and then returning another one. So by sharing it you always get the same instance.
 */
// Our Response Object
$Injector->alias('Http\Response', 'Http\HttpResponse');
$Injector->share('Http\HttpResponse');

// Our Request Object
$Injector->alias('Http\Request', 'Http\HttpRequest');
$Injector->share('Http\HttpRequest');
$Injector->define('Http\HttpRequest', [
	':get'     => $_GET,
	':post'    => $_POST,
	':cookies' => $_COOKIE,
	':files'   => $_FILES,
	':server'  => $_SERVER,
]);

// Authorization
$Injector->alias('Authorization', 'App\Middleware\Auth\JsonWebToken');

// Database
$Injector->alias('Database', 'Aura\Sql\ExtendedPdo');
$Injector->share('Aura\Sql\ExtendedPdo');
$Injector->define('Aura\Sql\ExtendedPdo', [
	'mysql:host=127.0.0.1;dbname=test',
	'root',
	'LX8]ffaj6FBF;8rZJK{Bg'
]);


/**
 * Handlers
 */
$Injector->define('App\Handlers\HomeController',
	[ 'response' => 'Http\Response' ],
	[ 'db' => 'Database' ]
);

$Injector->alias('App\Template\Renderer', 'App\Template\TwigRenderer');
$Injector->alias('App\Template\FrontendRenderer', 'App\Template\FrontendTwigRenderer');

$Injector->delegate('Twig_Environment', function () use ($Injector) {
	$loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/assets/templates');
	$twig = new Twig_Environment($loader);

	return $twig;
});

return $Injector;