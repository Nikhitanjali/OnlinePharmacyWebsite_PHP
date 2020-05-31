<?php
	session_start();
	//Kill the session to ogout
	session_destroy();
	//Redirect to login page
	header('Location: loginnew.php');
?>
