<?php

class UserTest extends \PHPUnit_Framework_TestCase{

	public function testCanCreateUser()
	{
		$User = new \App\Entities\User();
		$this->assertInstanceOf('App\Entities\User', $User);
	}


	public function testUserTwo()
	{
		$this->assertEquals(1,1);
	}
}