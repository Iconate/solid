<?php namespace App;

use Auryn\Injector;
use Phroute\HandlerResolverInterface;

/**
 * Class RouteResolver
 *
 * @package App
 */
class RouteResolver implements HandlerResolverInterface
{

	/**
	 * You can use any Dependency Container you like; I just happened to use \Auryn\Injector.
	 *
	 * @type Injector
	 */
	private $Injector;

	public function __construct(Injector $Injector)
	{
		$this->Injector = $Injector;
	}

	/**
	 * Called by Dispatcher
	 *
	 * @param   $handler
	 * @return  array
	 * @throws  \Auryn\InjectionException
	 */
	public function resolve($handler)
	{
		/*
		* Only attempt resolve uninstantiated objects which will be in the form:
		*
		*      $handler = ['App\Controllers\Home', 'method'];
		*/
		if ( is_array($handler) and is_string($handler[0]) ) {

			$handler[0] = $this->Injector->make($handler[0]);
		}

		return $handler;
	}
}