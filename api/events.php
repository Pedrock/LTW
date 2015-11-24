<?php
include_once('../database/events.php');
if (isset($_POST['id']) && isset($_POST['subscribe']))
{
	include_once('../core/require_session.php');
	if ($_POST['subscribe'] === 'true')
		echo json_encode(subscribeEvent(intval($_POST['id']),$_SESSION['user_id']));
	else if ($_POST['subscribe'] === 'false')
		echo json_encode(unsubscribeEvent(intval($_POST['id']),$_SESSION['user_id']));
}
else if (isset($_GET['search']))
{
	echo json_encode(searchEvents($_GET['search']));
}
else if (isset($_GET['id']) && isset($_GET['comments']))
{
	echo json_encode(getEventComments($_GET['id'], $_GET['comments']));
}
else if (isset($_POST['id']) && isset($_POST['comment']))
{
	include_once('../core/require_session.php');
	echo json_encode(createComment($_POST['id'], $_SESSION['user_id'], $_POST['comment']));
}
?>