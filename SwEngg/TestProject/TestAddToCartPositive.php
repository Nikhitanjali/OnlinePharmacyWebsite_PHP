<?php

require_once('addToCart.php');
use PHPUnit\Framework\TestCase;

class TestAddToCart extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $_POST = array();
    }
	public function tearDown(){ }
    public function testItemsToCart()
	{
		$cart = new AddToCart;
		$_POST = array(
			'ProductId'  => 28,
			'cartQty' => 2,
			'submit' =>  1
		); 
		$_SESSION['id'] = 'mpalkar@gmail.com';
		$_REQUEST = 'POST';
		$this->assertTrue($cart->itemsToCart($_POST,$_SESSION, $_REQUEST) == 1);
    }
}
?>