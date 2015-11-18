<?php
	include_once('database/users.php');
	if(isSet($_POST['email']) && isSet($_POST['password']) && isSet($_POST['fname']) && isSet($_POST['lname'])
		&& registerUser($_POST['email'],$_POST['password'],$_POST['fname'],$_POST['lname'])) {
		header("Location: index?register=success");
		die();
	}
	else
	{
		header("Location: index?register=failed");
		die();
	}
?>