<?php namespace App\Middleware\Auth;

use \Firebase\JWT\JWT;
use Http\Response;

class JsonWebToken implements AuthorizationInterface{

	protected $Response;

	public function __construct(Response $response)
	{
		$this->Response = $response;
	}

	public function authorize()
	{
		// do jwt check
		// ...
		//$this->Response->setStatusCode(401);
	}
}