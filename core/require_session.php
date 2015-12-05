<?php
	include_once(file_exists("database/users.php") ? 'database/users.php' : '../database/users.php');
	include_once(file_exists("core/common.php") ? 'core/common.php' : '../core/common.php');
	if (!isset($_SESSION['user_id']) || !validSession($_SESSION['user_id'])) {
		session_destroy();
		include('templates/401.php');
		die();
	}
?>