<?php
	include_once('database/users.php');
	session_start();
	if(isSet($_POST['email']) && isSet($_POST['password']) && login($_POST['email'],$_POST['password']))
	{
		header("Location: index");
		die();
	}
	else
	{
		header("Location: index?login=failed");
		die();
	}
?>