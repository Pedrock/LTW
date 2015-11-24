<?php
	include_once('database/users.php');
	session_start();
	if(isSet($_POST['email-login']) && isSet($_POST['password-login']) 
			&& ($user_id = login($_POST['email-login'],$_POST['password-login'])) && $user_id !== false)
	{
		$_SESSION['user_id'] = $user_id;
		header("Location: ./");
		die();
	}
	else
	{
		if (isSet($_POST['email-login']) && isSet($_POST['password-login']))
		{
			$valid_email = userExists($_POST['email-login']);
			$user_id = login($_POST['email-login'],$_POST['password-login']);
			if ($valid_email && $user_id !== false)
			{
				$_SESSION['user_id'] = $user_id;
				header("Location: ../");
				die();
			}
			$_GLOBALS['LOGIN'] = array("email" => !$valid_email, "password" => ($valid_email && $user_id === false));
		}
		include('templates/login_page.php');
	}
?>