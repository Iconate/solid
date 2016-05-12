<?php namespace App;

use Auryn\Injector;
use Phroute\HandlerResolverInterface;

class RouteResolver implements HandlerResolverInterface{

	private $Injector;

	public function __construct(Injector $Injector)
	{
		$this->Injector = $Injector;
	}


	public function resolve($handler){
		/*
		* Only attempt resolve uninstantiated objects which will be in the form:
		*
		*      $handler = ['App\Controllers\Home', 'method'];
		*/
		if(is_array($handler) and is_string($handler[0]))
		{

			$handler[0] = $this->Injector->make($handler[0]);
		}

		return $handler;
	}
}