<?php
	include_once('database/users.php');
	include_once('templates/common.php');
	if (!isset($_SESSION['user_id']) || !validSession($_SESSION['user_id'])) {
		session_destroy();
	}
?>