<?php
if (session_id() === "") session_start();
if (!isSet($_SESSION['user_id']))
{
	include('401.php');
}
include_once(file_exists("database/events.php") ? 'database/events.php' : '../database/events.php');
$row = getEvent($_REQUEST['id']);
if ($row === false)
{
	include('404.php');
	die();
}
else if ($_SESSION['user_id'] !== $row['user_id'])
{
	include('401.php');
	die();
}
?>