<?php
	include_once('database/users.php');

	if ($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		$valid_fname = !empty($_POST['fname']) && preg_match("/^[A-zÀ-ÿ]+$/", $_POST['fname']);
		$valid_lname = !empty($_POST['lname']) && preg_match("/^[A-zÀ-ÿ]+$/", $_POST['lname']);
		$valid_email = !empty($_POST['email']) 
			&& preg_match("/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i", $_POST['email']);
		$email_in_use = $valid_email ? userExists($_POST['email']) : false;
		$valid_password = !empty($_POST['password']) && strlen($_POST['password'])>=8;
		$valid_password2 = $valid_password ? (!empty($_POST['password2']) && $_POST['password2'] === $_POST['password']) : true;

		if ($valid_fname && $valid_lname && $valid_email && !$email_in_use && $valid_password && $valid_password2)
		{
			session_start();
			registerUser($_POST['email'],$_POST['password'],$_POST['fname'],$_POST['lname']);
			header("Location: ./");
			die();
		}
		else
		{
			$_GLOBALS['REGISTER'] = array("fname" => !$valid_fname, "lname" => !$valid_lname, "email" => !$valid_email, "email-in-use" => $email_in_use,
				"password" => !$valid_password, "password2" => !$valid_password2);
			include('templates/login_page.php');
		}
	}
	else
	{
		header("Location: ./");
		die();
	}
?>