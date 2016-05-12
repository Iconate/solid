<?php
require __DIR__ . '/../config/config.php';

$Injector = new \Auryn\Injector;

/**
 * ====================================
 *        HTTP Request/Response
 * ====================================
 */
$Injector->alias('Http\Response', 'Http\HttpResponse');
$Injector->share('Http\HttpResponse');

$Injector->alias('Http\Request', 'Http\HttpRequest');
$Injector->share('Http\HttpRequest');
$Injector->define('Http\HttpRequest', [
	':get'     => $_GET,
	':post'    => $_POST,
	':cookies' => $_COOKIE,
	':files'   => $_FILES,
	':server'  => $_SERVER,
]);

/**
 * ====================================
 *              Database
 * ====================================
 */
$Injector->alias('Database', 'Aura\Sql\ExtendedPdo');
$Injector->share('Aura\Sql\ExtendedPdo');
$Injector->define('Aura\Sql\ExtendedPdo', [
	"mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
	DB_USER,
	DB_PASS
]);

/**
 * ====================================
 *              Handlers
 * ====================================
 */
$Injector->define('App\Handlers\HomeController', [
	'response' => 'Http\Response',
	'db'       => 'Database'
]);

/**
 * ====================================
 *              Middleware
 * ====================================
 */
$Injector->alias('Authorization', 'App\Middleware\Auth\JsonWebToken');

return $Injector;