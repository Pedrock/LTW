<?php
	include_once('core/common.php');
	if (isSet($_SESSION['user_id']))
	{
		include('templates/main_page.php');
	}
	else
	{
		include('templates/login_page.php');
	}
?>