<?php namespace App\Services;

use App\Repositories\UserRepo;

class UserService
{

	protected $UserRepo;

	public function __construct(UserRepo $userRepo)
	{
		$this->UserRepo = $userRepo;
	}

	public function login()
	{
		return $this->UserRepo->findAll();
	}
}