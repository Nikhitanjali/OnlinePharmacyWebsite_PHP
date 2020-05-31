<?php

require_once('checkDocDetails.php');
use PHPUnit\Framework\TestCase;

class TestDocDetails extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $_POST = array();
    }
	public function tearDown(){ }
   
    public function testDoctorDetails()
	{
		$doctor = new CheckDocDetails();
		$_POST = array(
			'dName'  =>  'Derek Shepherd',
			'dNPINum' => '7654567896',
			'prescription' =>  'pr1.png',
			'dEmailId'  =>  'shepherd@gmail.com',
			'UserId'     =>  'alicia@gmail.com',
			'submit' => 1
		); 
		$_SESSION['id'] = 'mpalkar@gmail.com';
		$_REQUEST = 'POST';
		echo $this->assertTrue($doctor->CheckDoc($_POST, $_REQUEST) == 3);
		
    }
}
?>