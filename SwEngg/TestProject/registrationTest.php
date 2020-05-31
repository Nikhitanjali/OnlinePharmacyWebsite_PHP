<?php

require_once('registration.php');
use PHPUnit\Framework\TestCase;

class TestRegister extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $_POST = array();
    }
	public function tearDown(){ }
   
    public function testRegisterIsValid()
	{
		$user = new registration();
		$_POST = array(
			'username'  =>  'testuser@gmail.com',
			'password' => 'password',
			'firstname' =>  'test',
			'lastname'  =>  'test',
			'gender'     =>  'Male',
			'DOB'  =>  '1994-07-13',
			'chkBox' => 'on',
			'govtID' => 'test.jpg',
			'submit' => 1
		); 
		$_REQUEST = 'POST';
		$this->assertTrue($user->save($_POST, $_REQUEST) == 5);
    }
}
?>