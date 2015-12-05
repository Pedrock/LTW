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
	$invited = $row['invited'];
}
if ($row === false)
{
	include('templates/404.php');
}
else if ((!isSet($_SESSION['user_id']) && !$row['public']) || (isSet($_SESSION['user_id']) && !$subscribed && !$owner && !$invited && !$row['public']))
{
	include('templates/401.php');
}
?>