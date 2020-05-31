<?php

require_once('success.php');
use PHPUnit\Framework\TestCase;

class TestMail extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $_GET = array();
    }
	public function tearDown(){ }
    public function testpay()
	{
		$mailCheck = new paymentSuccess;
		$_POST = array(
			'tNum'  => '8.00'
		); 
		$_SESSION['id'] = 'aarthisingh19399@gmail.com';
		$this->assertTrue($mailCheck->testSendMail($_POST,$_SESSION) == 1);
    }
}
?>