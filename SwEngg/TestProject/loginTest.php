<?php

require_once('login.php');
use PHPUnit\Framework\TestCase;


class loginTest extends TestCase
{
  public function setUp(){ }
  public function tearDown(){ }

  public function testLoginIsValid()
  {
    // test to ensure that the loginPage is working
    $connObj = new login;
    $_POST['username'] = 'MedAnytime2019@gmail.com';
	$_POST['password'] = 'gaya3';
	$_SERVER["REQUEST_METHOD"] = "POST";
    $this->assertTrue($connObj->loginNewTest($_POST['username'],$_POST['password'],$_SERVER["REQUEST_METHOD"]) == true);
  }
}
?>