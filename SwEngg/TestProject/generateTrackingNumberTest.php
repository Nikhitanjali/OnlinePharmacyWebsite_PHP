<?php

require_once('OrderPlaced.php');
use PHPUnit\Framework\TestCase;

class TestGenerateTrackingNumber extends TestCase
{
	
	public function tearDown(){ }
   
    public function testgenerateTrack()
	{
		$ordr = new OrderPlaced;
		$_SESSION['id'] = "mpalkar@gmail.com";
		$_REQUEST = 'POST';
		$this->assertTrue($ordr->generateTrackingNumber($_SESSION, $_REQUEST) == 1);
    }
}
?>