<?php
	include_once('database/users.php');
	session_start();
	if(isSet($_POST['email']) && isSet($_POST['password']) && login($_POST['email'],$_POST['password']))
	{
		header("Location: ./");
		die();
	}
	else
	{
		header("Location: ./?login=failed");
		die();
	}
?>