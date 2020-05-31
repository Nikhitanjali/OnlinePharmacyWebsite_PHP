<?php

require_once('product_update.php');
use PHPUnit\Framework\TestCase;

class ProductUpdateTest extends TestCase
{
	
	protected function setUp()
	{	}
		   
	public function testproductUpdate()
	{
		error_reporting(E_ALL);
        ini_set('display_errors', '1');
		echo "I am here t test";
		$prod = new product_update;
		$_POST = array(
			'ID' => '3',
			'ProductName' => 'Coldcalm',
			'CompanyName' => 'Boiron',
			'CureFor' => 'Cold',
			'Price' => '12.00',
			'OtcFlag' => 'Y',
			'ExpiryDate' => '2020-10-01',
			'quantity' => '40',
			'FeaturedFlag' => 'N',
			'update' => 1
		); 
		//$_REQUEST = 'POST';
		$this->assertTrue($prod->prodUpdate($_POST) == 2);
	}	
	
	protected function tearDown(){
		//setVerboseErrorHandler();
	}
}
?>

