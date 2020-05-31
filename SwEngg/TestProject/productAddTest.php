<?php

require_once('product_add.php');
use PHPUnit\Framework\TestCase;

class TestProductAdd extends TestCase
{
	
	public function tearDown(){ }
   
    public function testProductAdd()
	{
		$prod = new productAdd;
		$_POST['prod_name'] = 'TestProduct';
		$_POST['comp_name'] = 'TestComp';
		$_POST['price'] = '5.99';
		$_POST['cureFor'] = 'test';
		$_POST['otcFlag'] = 'Y';
		$_POST['quantity'] = '60';
		$_POST['prodImage'] = 'abc.jpg';
		$_POST['expDate'] = '2022-12-22';
		$_POST['featuredFlag'] = 'N';
		$_POST['submit'] = 1;
		
		$_FILES['prodImage'] = 'prodImage.png';
		$_REQUEST = 'POST';
		$this->assertTrue($prod->saveProductTest($_POST,$_FILES, $_REQUEST) == 3);
    }
}
?>