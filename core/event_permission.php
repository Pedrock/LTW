<?php
if (session_id() === "") session_start();
include_once(file_exists("database/events.php") ? 'database/events.php' : '../database/events.php');
if (isSet($_SESSION['user_id']))
	$row = getEventAndSubscription($_REQUEST['id'],$_SESSION['user_id']);
else $row = getEvent($_REQUEST['id']);

if (isSet($_SESSION['user_id']))
{
	$subscribed = $row['subscribed'];
	$owner = ($_SESSION['user_id'] === $row['user_id']);
}
if ($row === false)
{
	header("HTTP/1.0 404 Not Found");
	include('404.php');
	die();
}
else if ((!isSet($_SESSION['user_id']) && !$row['public']) || (isSet($_SESSION['user_id']) && !$subscribed && !$owner && !$row['public']))
{
	header("HTTP/1.0 401 Unauthorized");
	include('401.php');
	die();
}
?>