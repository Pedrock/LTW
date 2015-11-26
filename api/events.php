<?php
include_once('../database/events.php');
if (isset($_POST['id']) && isset($_POST['subscribe']))
{
	include_once('../core/require_session.php');
	include_once("../core/event_permission.php");
	if ($_POST['subscribe'] === 'true')
		echo json_encode(subscribeEvent($_POST['id'],$_SESSION['user_id']));
	else if ($_POST['subscribe'] === 'false')
		echo json_encode(unsubscribeEvent($_POST['id'],$_SESSION['user_id']));
}
else if (isset($_GET['search']))
{	
	include_once('../core/session.php');
	echo json_encode(searchEvents($_GET['search'],isset($_SESSION['user_id'])?$_SESSION['user_id']:false));
}
else if (isset($_GET['id']) && isset($_GET['last-comment']))
{
	include_once("../core/event_permission.php");
	echo json_encode(getEventComments($_GET['id'], $_GET['last-comment']));
}
else if (isset($_POST['id']) && isset($_POST['last-comment']) && isset($_POST['comment']))
{
	include_once('../core/require_session.php');
	include_once("../core/event_permission.php");
	// Pode comentar sem estar subscrito mas só se estiver publico
	if (createComment($_POST['id'], $_SESSION['user_id'], $_POST['comment']))
	{
		echo json_encode(getEventComments($_POST['id'], $_POST['last-comment']));
	}
	else return false;
}
?>