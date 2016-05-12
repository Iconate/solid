<?php
/**
 * ====================================
 *          Route Structure
 * ====================================
 *
 * [
 *      $HTTP_METHOD - GET|POST|DELETE|PUT etc...
 *      $ROUTE       - Patten matching allowed
 *      $CLASS       - Class to handle the request (aliases allowed)
 *      $METHOD      - Method contained within the class to call
 *      $FILTERS     - Middleware to be invoked before and/or after the $CLASS is called
 * ]
 */
return [
	['GET','/example/{id}', 'App\Handlers\HomeController', 'index', ['before' => 'auth']],
];
