<?php
namespace App\Handlers;

use App\Services\UserService;
use Aura\Sql\ExtendedPdo as Database;
use Http\Response;

class HomeController
{
    private $Response;
	private $UserService;

    public function __construct(
        Response $response,
		UserService $userService
    )
    {
        $this->Response = $response;
	    $this->UserService = $userService;
    }

    public function index()
    {
	    $results = $this->UserService->login();
	    $this->Response->setContent(json_encode($results));
    }
}