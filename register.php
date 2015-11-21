<?php
	include_once('database/users.php');
	if(isSet($_POST['email']) && preg_match("/^\w+[@]\w+[.]\w+/", $_POST['email'])
		&& isSet($_POST['password']) && isSet($_POST['password2'])
		&& $_POST['password']==$_POST['password2'] 
		&& strlen($_POST['password'])>=8
		&& isSet($_POST['fname']) && isSet($_POST['lname'])
		&& registerUser($_POST['email'],$_POST['password'],$_POST['fname'],$_POST['lname'])) {
		header("Location: ./?register=success");
		die();
	}
	else
	{		
		include('templates/login_page.php');
	}
?>