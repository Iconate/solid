<?php namespace App\Repositories;

use Aura\Sql\ExtendedPdo as Database;

class UserRepo
{
	protected $db;

	public function __construct(Database $db)
	{
		$this->db = $db;
	}

	public function findAll($returnObj = false)
	{
		$sql = "SELECT * FROM users";

		return $this->db->fetchObjects($sql, array(), '\App\Entities\User');
	}
}