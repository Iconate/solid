<?php

namespace App;

use Phroute\Exception\HttpMethodNotAllowedException;
use Phroute\Exception\HttpRouteNotFoundException;

require __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);

/**
 * Register the error handler
 */
$ErrorHandler = new \Whoops\Run;
$ErrorHandler->pushHandler(new \Whoops\Handler\PrettyPageHandler);
//
//if ( $_SERVER['APP_ENV'] !== 'prod' ) {
//	$ErrorHandler->pushHandler(new \Whoops\Handler\PrettyPageHandler);
//} else {
//	$ErrorHandler->pushHandler(function ($e) {
//		echo 'Friendly error page and send an email to the developer';
//	});
//}

$ErrorHandler->register();

/**
 * Set up Request and Response objects
 */

$RouteCollector = new \Phroute\RouteCollector();

// Authorization is an alias defined in Dependencies.php
$RouteCollector->filter('auth', [ 'Authorization', 'authorization' ]);

$routes = include( 'Routes.php' );
foreach ( $routes as $route ) {
	$httpMethod = $route[0];
	$path = $route[1];
	$controller = $route[2];
	$method = $route[3];
	$filters = isset( $route[4] ) && is_array($route[4]) ? $route[4] : null;

	if ( $filters ) {
		$RouteCollector->addRoute($httpMethod, $path, [ $controller, $method ], $filters);
	} else {
		$RouteCollector->addRoute($httpMethod, $path, [ $controller, $method ]);
	}
}

$Injector = include( 'Dependencies.php' );
$RouteResolver = new RouteResolver($Injector);

$Dispatcher = new \Phroute\Dispatcher($RouteCollector, $RouteResolver);

/**
 * which has an alias- Http\Response
 *
 * @var \Http\HttpResponse
 */
$Response = $Injector->make('Http\Response');
try {
	$Dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
} catch (HttpRouteNotFoundException $e) {
	$Response->setContent('404 - Page not found');
	$Response->setStatusCode(404);
} catch (HttpMethodNotAllowedException $e) {
	$Response->setContent('405 - Method not allowed');
	$Response->setStatusCode(405);
}

/**
 * This will send the response data to the browser. If you don't do this, nothing happens as the
 * Response object only stores data. This is handled differently by most other HTTP components
 * where the classes send data back to the browser as a side-effect, so keep that in mind if you use another component.
 */
foreach ( $Response->getHeaders() as $header ) {
	// The second parameter of header() is false because otherwise existing headers will be overwritten.
	header($header, false);
}

echo $Response->getContent();