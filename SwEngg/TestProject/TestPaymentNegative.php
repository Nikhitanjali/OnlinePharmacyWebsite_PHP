<?php

require_once('success.php');
use PHPUnit\Framework\TestCase;

class TestPayment extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $_GET = array();
    }
	public function tearDown(){ }
    public function testpay()
	{
		$tpay = new paymentSuccess;
		$_GET = array(
			'amt'  => '8.00',
			'cc' => 'USD',
			'item_name' => 'zzzquil',
			'tx' => '0U2290365H3589605',
			'submit' =>  1
		); 
		$_SESSION['id'] = 'mpalkar@gmail.com';
		$_REQUEST = 'POST';
		$this->assertTrue($tpay->testPaymentSuccess($_GET,$_SESSION, $_REQUEST) == 1);
    }
}
?>