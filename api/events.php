<?php
header('Content-Type: application/json');
set_include_path('..');
include_once('database/events.php');
if (isset($_POST['id']) && isset($_POST['subscribe']))
{
	include_once('core/require_session.php');
	include_once("core/event_permission.php");
	if ($_POST['subscribe'] === 'true')
	{
		if (subscribeEvent($_POST['id'],$_SESSION['user_id']))
			echo json_encode(getEventSubscribers($_POST['id']));
	}
	else if ($_POST['subscribe'] === 'false')
	{
		if (unsubscribeEvent($_POST['id'],$_SESSION['user_id']))
			echo json_encode(getEventSubscribers($_POST['id']));
	}
}
else if (isset($_GET['search']))
{	
	include_once('core/session.php');
	echo json_encode(searchEvents($_GET['search'],isset($_SESSION['user_id'])?$_SESSION['user_id']:false));
}
else if (isset($_GET['id']) && isset($_GET['last-comment']))
{
	include_once("core/event_permission.php");
	echo json_encode(getEventComments($_GET['id'], $_GET['last-comment']));
}
else if (isset($_POST['id']) && isset($_POST['last-comment']) && isset($_POST['comment']))
{
	include_once('core/require_session.php');
	include_once("core/event_permission.php");
	if (createComment($_POST['id'], $_SESSION['user_id'], $_POST['comment']))
	{
		echo json_encode(getEventComments($_POST['id'], $_POST['last-comment']));
	}
	else return false;
}
else if (isset($_POST['id']) && isset($_POST['invite']))
{
	include_once('core/require_session.php');
	try {
		$name = inviteToEvent($_POST['invite'], $_POST['id'], $_SESSION['user_id']);
		echo json_encode(array('error' => false, 'user' => $name));
	}
	catch (InviteYourselfException $e)
	{
		echo json_encode(array('error' => $lang['CANT_INVITE_YOURSELF']));
	}
	catch (EmailException $e) {
		echo json_encode(array('error' => $lang['UNREGISTERED_EMAIL']));
	}
	catch (SubscribedException $e) {
		echo json_encode(array('error' => $lang['ALREADY_SUBSCRIBED']));
	}
	catch (InvitedException $e) {
		echo json_encode(array('error' => $lang['ALREADY_INVITED']));
	}
	catch (PermissionException $e) {
		echo json_encode(false);
	}
}
else
{
	include('404.php');
}
?>